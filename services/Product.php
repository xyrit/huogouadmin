<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 15/9/25
 * Time: 下午2:19
 */
namespace app\services;

use app\models\CurrentPeriod;
use app\models\Period as PeriodModel;
use app\models\ProductCategory;
use app\models\ProductImage;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\models\Product as ProductModel;

class Product
{
    /**
     *  获取商品列表
     * @param $catId
     * @param $brandId
     * @param $page
     * @param $orderFlag  排序方式 10=即将揭晓，20=人气，30=剩余人次，40=最新，50=价格正序，51=价格倒序,60=热门推荐
     * @param $isLimit  是否限购 all=全部,0=不限购，1=限购
     * @param int $perpage
     *
     */
    public static function getList($catId, $brandId, $page, $orderFlag = 0, $isLimit = 'all', $perpage = 20,$extraWhere="")
    {
        $where = ['marketable'=>1];
        if ($catId) {
            $cats = ProductCategory::allOrderList($catId);
            if (!$cats) {
                $where['products.cat_id'] = $catId;
            } else {
                $catIds[] = $catId;
                $catIds = ArrayHelper::getColumn($cats, 'id');
                $where['products.cat_id'] = $catIds;
            }
        }
        if ($brandId) {
            $where['products.brand_id'] = $brandId;
        }
        $where['products.marketable'] = 1;
        $query = \app\models\Product::find()
            ->select('products.*,c.limit_num limit_num,c.id period_id,c.period_number period_number,c.sales_num sales_num, c.left_num left_num,c.price period_price')
            ->leftJoin('current_periods c', 'c.product_id = products.id')
            ->where($where);
        if ($extraWhere) {
            $query->where($extraWhere);
        }    
        if ($isLimit !== 'all') {
            if ($isLimit) {
                $query->andWhere(['<>','c.limit_num',0]);
            } else {
                $query->andWhere(['=','c.limit_num',0]);
            }
        }
        switch ($orderFlag) {
            case 10:
                $orderBy = 'c.progress desc';//即将揭晓
                break;
            case 20:
                $orderBy = 'c.period_number desc';//人气
                break;
            case 30:
                $orderBy = 'c.left_num asc';//剩余人次
                break;
            case 40:
                $orderBy = 'products.created_at desc';//最新
                break;
            case 50:
                $orderBy = 'c.price asc';//价格正序
                break;
            case 51:
                $orderBy = 'c.price desc';//价格倒序
                break;
            case 60:
                $query->andWhere(['is_recommend'=>1]);//热门推荐
                $orderBy = 'products.list_order desc';
                break;
            default:
                $orderBy = '';
                break;
        }
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page'=>$page -1,'defaultPageSize'=>$perpage]);
        $query->orderBy($orderBy);
        $products = $query->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        $return['list'] = $products;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        return $return;
    }

    /** 商品信息
     * @param $id 商品ID
     * @return array|null
     */
    public static function info($id)
    {
        if (is_array($id)) {
            $product = ProductModel::find()->where(['id'=>$id])->indexBy('id')->asArray()->all();
        } else {
            $product = ProductModel::find()->where(['id'=>$id])->asArray()->one();
        }
        return $product;
    }

    /**
     * 获取商品名
     */
    public static function getProductName()
    {
        $all = \app\models\Product::find()->all();
        return ArrayHelper::map($all, 'id', 'name');
    }

    /**
     * 获取商品发货方式
     */
    public static function getProductDeliver()
    {
        $all = \app\models\Product::find()->all();
        return ArrayHelper::map($all, 'id', 'delivery_id');
    }

    /**
     * 获取商品分类方式
     */
    public static function getProductCate()
    {
        $all = \app\models\Product::find()->all();
        return ArrayHelper::map($all, 'id', 'cat_id');
    }


    /** 商品当前期数信息
     * @param $id 商品ID
     * @return array|null
     */
    public static function curPeriodInfo($id)
    {
        if (is_array($id)) {
            $currentPeriod = CurrentPeriod::find()->where(['product_id'=>$id])->indexBy('id')->asArray()->all();
        } else {
            $currentPeriod = CurrentPeriod::find()->where(['product_id'=>$id])->asArray()->one();
        }
        return $currentPeriod;
    }

    /** 当前期数信息
     * @param $id 期数ID
     * @return array|null
     */
    public static function curPeriod($id)
    {
        if (is_array($id)) {
            $currentPeriod = CurrentPeriod::find()->where(['id'=>$id])->indexBy('id')->asArray()->all();
        } else {
            $currentPeriod = CurrentPeriod::find()->where(['id'=>$id])->asArray()->one();
        }
        return $currentPeriod;
    }

    /**
     * 商品所有图片
     * @param $id 商品ID
     */
    public static function images($id)
    {
        $productImage = ProductImage::find()->select('basename')->where(['product_id'=>$id])->asArray()->all();
        $images = ArrayHelper::getColumn($productImage, 'basename');
        return $images;
    }

    /**
     *  商品已满员期数列表
     * @param $id   商品ID
     * @param $page
     * @param int $perpage
     */
    public static function perioadList($id, $page, $perpage = 20,$offset)
    {
        $query = PeriodModel::find()->where(['product_id'=>$id]);
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page'=>$page -1,'defaultPageSize'=>$perpage]);
        if ($offset >= $perpage) {
            $query->where(['and','product_id='.$id,['<=','period_number',$offset]]);
        }else if ($offset > 0) {
            $query->where(['and','product_id='.$id,['<=','period_number',$perpage-1]]);
        }
        $perioadList = $query->orderBy('id desc')->offset($pagination->offset)->limit($pagination->defaultPageSize)->asArray()->all();

        $return['list'] = $perioadList;
        $return['totalCount'] = $totalCount;
        $return['totalPage'] = $pagination->getPageCount();
        $return['offset'] = $offset;
        return $return;
    }




}