<?php

namespace app\models;

use app\helpers\MyRedis;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $bn
 * @property string $barcode
 * @property string $name
 * @property integer $price
 * @property integer $marketable
 * @property integer $cost
 * @property integer $face_value
 * @property integer $cat_id
 * @property integer $brand_id
 * @property integer $delivery_id
 * @property integer $order_manage_gid
 * @property integer $total
 * @property integer $store
 * @property integer $limit_num
 * @property integer $buy_unit
 * @property integer $allow_share
 * @property integer $is_recommend
 * @property integer $list_order
 * @property string $brief
 * @property string $intro
 * @property string $picture
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $display
 */
class Product extends \yii\db\ActiveRecord
{
    const PERIOD_ALL_CODE_KEY = 'PERIOD_ALL_CODE_';  // set 码表  productid__periodid
    public static $deliveries = [
        1 => '第三方平台',
        2 => '自建仓发货',
        3 => '话费卡密',
        4 => '供应商代发',
        5 => '兑吧支付宝',
        6 => '兑吧Q币',
        7 => '兑吧话费',
        8 => '京东卡密',
        9 => 'Q币直充',
        10 => '话费直充'
    ];

    /**
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'cat_id', 'brand_id', 'delivery_id',  'order_manage_gid','created_at', 'updated_at'], 'required'],
            [['display', 'price', 'cost', 'face_value', 'marketable', 'cat_id', 'brand_id', 'order_manage_gid', 'total', 'store', 'limit_num', 'is_recommend', 'list_order', 'allow_share', 'created_at', 'updated_at'], 'integer'],
            [['intro'], 'string'],
            [['delivery_id'], 'string', 'max' => 32],
            [['bn', 'barcode', 'name', 'brief', 'picture', 'tag', 'keywords'], 'string', 'max' => 255],
            [['order_manage_gid'], 'validateOrderManageGid'],
            [['limit_num'], 'validateLimitNum'],
            [['price'], 'validatePrice'],
            [['buy_unit'], 'validateBuyUnit'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bn' => '商品编号',
            'barcode' => '商品条码',
            'name' => '商品名称',
            'price' => '伙购价',
            'marketable' => '是否上架',
            'cost' => '成本价',
            'face_value' => '面值',
            'cat_id' => '分类',
            'brand_id' => '品牌',
            'delivery_id' => '发货方式',
            'order_manage_gid' => '订单处理小组',
            'total' => '库存',
            'store' => '伙购期数',
            'limit_num' => '限购数量',
            'buy_unit' => '十倍专区',
            'allow_share' => '允许晒单',
            'is_recommend' => '是否推荐',
            'list_order' => '排序',
            'brief' => '商品简介',
            'intro' => '详细介绍',
            'picture' => '商品相册',
            'tag' => '标签',
            'keywords' => '关键字',
            'display' => '显示地址',
        ];
    }

    public function validateOrderManageGid($attribute, $params)
    {
        if ($this->delivery_id == 1 || $this->delivery_id == 2) {
            if (!$this->order_manage_gid) {
                $this->addError($attribute, '请选择订单处理小组');
            }
        }
    }

    public function validateLimitNum($attribute, $params)
    {
        if ($this->limit_num >= $this->price) {
            $this->addError($attribute, '限购次数只能小于价格');
        }
        if ($this->buy_unit==10 && $this->limit_num>0) {
            $this->addError($attribute, '十元专区不能限购');
        }
    }

    public function validatePrice($attribute, $params)
    {
        if ($this->buy_unit==10 && $this->price%10>0) {
            $this->addError($attribute, '十元专区的价格必须是10的倍数');
        }
    }

    public function validateBuyUnit($attribute, $params)
    {
        if (!in_array($this->buy_unit,[1,10])) {
            $this->addError($attribute, '购买单位只能是1或10');
        }
    }

    public static function getList($condition = '', $page = 1, $pageSize = 10)
    {
        $query = Product::find()->leftJoin('current_periods as c', 'products.id=c.product_id')->select(['products.*', 'IFNULL(c.period_number, 0) as period_number']);
        if ($condition) {
            if ($condition['bn']) {
                $query->andWhere(['products.bn' => $condition['bn']]);
            }
            if ($condition['name']) {
                $query->andWhere(['or',"products.name like '%".$condition['name']."%'",['or',"tag like '%".$condition['name']."%'"]]);
            }
            if ($condition['marketable'] != 'all') {
                $query->andWhere(['products.marketable' => $condition['marketable']]);
            }
            if ($condition['allow_share'] != 'all') {
                $query->andWhere(['products.allow_share' => $condition['allow_share']]);
            }
            if ($condition['limit_num'] != 'all') {
                if ($condition['limit_num'] == 0) {
                    $query->andWhere(['products.limit_num' => $condition['limit_num']]);
                } else {
                    $query->andWhere(['>=', 'products.limit_num', $condition['limit_num']]);
                }
            }
            if ($condition['buy_unit'] != 'all') {
                if ($condition['buy_unit'] == 0) {
                    $query->andWhere(['products.buy_unit' => 0]);
                } else {
                    $query->andWhere(['products.buy_unit' => $condition['buy_unit']]);
                }
            }
            if ($condition['cat_id']) {
                $catids = ProductCategory::children($condition['cat_id']);
                $catids = ArrayHelper::getColumn($catids, 'id');
                array_push($catids, $condition['cat_id']);
                $query->andWhere(['products.cat_id' => $catids]);
            }
            if ($condition['sort'] && $condition['order']) {
                if ($condition['sort'] == 'period_number') {
                    $query->orderBy('c.' . $condition['sort'] . ' ' . $condition['order']);
                } else {
                    $query->orderBy('products.' . $condition['sort'] . ' ' . $condition['order']);
                }
            }
        }

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize ]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
//file_put_contents('sql.txt',print_r($query->createCommand()->getRawSql(), true).PHP_EOL,FILE_APPEND);
        return ['rows' => $list, 'total' => $pagination->totalCount];
    }

    /**
     * 商品上下架
     * @param $productModel
     * @param $market
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function market($productModel, $market)
    {

        set_time_limit(0);
        $trans = Yii::$app->db->beginTransaction();
        try {
            $oldMarket = $productModel['marketable'];
            $productId = $productModel['id'];
            $productModel->marketable = $market;
            if (!$productModel->save()) {
                $trans->rollBack();
                return false;
            }

            if ($market == 1) {
                if ($oldMarket == 2) { //新商品 未上架过
                    self::initCurrentPeriodInfo($productModel);
                } else {
                    $currenPeriod = CurrentPeriod::findOne(['product_id' => $productId]);
                    if (!$currenPeriod) {
                        $conn = Yii::$app->db;
                        //增加期数
                        $command = $conn->createCommand("select period_number from periods where product_id = {$productId} order by id desc");
                        $period = $command->queryOne();
                        self::initCurrentPeriodInfo($productModel, $period['period_number'] + 1);
                    }
                }
            } else {
                $currenPeriod = CurrentPeriod::findOne(['product_id' => $productId]);
                if ($currenPeriod && $currenPeriod['sales_num'] == 0) {
                    $currenPeriod->delete();
                }
            }

            $trans->commit();
            return true;
        } catch (\Exception $e) {
            $trans->rollBack();
            return false;
        }
    }


    /**
     * 初始化期数
     * @param $productModel
     * @param int $period_numer
     */
    private static function initCurrentPeriodInfo($productModel, $period_numer = 1)
    {
        $currentPeriod = CurrentPeriod::findOne(['product_id' => $productModel->id]);
        if (!$currentPeriod) {
            $currentPeriod = new CurrentPeriod();
            $currentPeriod->table_id = mt_rand(100, 109);
            $currentPeriod->product_id = $productModel->id;
            $currentPeriod->price = $productModel->price;
            $currentPeriod->limit_num = $productModel->limit_num;
            $currentPeriod->buy_unit = $productModel->buy_unit;
            $currentPeriod->period_number = $period_numer;
            $currentPeriod->sales_num = 0;
            $currentPeriod->progress = 0;
            $currentPeriod->left_num = $productModel->price;
            $currentPeriod->start_time = microtime(true);
            $currentPeriod->save(false);

            $currentPeriod->period_no = static::getPeriodNo(ArrayHelper::toArray($currentPeriod));
            $currentPeriod->save(false);

            $periodId = $currentPeriod->id;
            static::initCodes(ArrayHelper::toArray($productModel), $periodId);

        }
    }

    private static function initCodes($product,$periodId)
    {

        $redis = new MyRedis();
        $codeKey = self::PERIOD_ALL_CODE_KEY.$periodId;

        $start = 10000001;
        $end = $start + $product['price'];
        $pipe = $redis->pipeline();
        for ($i=$start;$i<$end;$i++) {
            $pipe->sadd($codeKey,$i);
            $num = $i - $start + 1;
            if (($num > 0 && $num % 10000 == 0) || $i == ($end-1)) {
                $pipe->exec();
                if($i!=($end-1)) {
                    $pipe = $redis->pipeline();
                }
            }
        }

        if ($redis->slen($codeKey) != $product['price']) {
            $redis->del($codeKey);
            static::initCodes($product,$periodId);
        }
    }

    /** 获取期号
     * @param $period
     * @return string
     */
    public static function getPeriodNo($period)
    {
        $startTime = $period['start_time'];
        $periodId = $period['id'];
        $date = date('Y-m-d', intval($startTime));
        $start = strtotime($date);
        $end = $start + 3600*24;
        $sql = "select rowno,id,start_time from (select (@rowno:=@rowno+1) as rowno,a.* from ( select * from ((select id,start_time from periods where start_time > '".$start."' and start_time < '".$end."' order by start_time asc) union all (select id,start_time from current_periods where start_time > '".$start."' and start_time < '".$end."' order by start_time asc ) ) as k order by k.start_time asc) as a ,(select @rowno:=0) t) as b where b.id=".$periodId;
        $db = \Yii::$app->db;
        $query = $db->createCommand($sql);
        $result = $query->queryOne();

        $no = $result['rowno'];

        $periodNo = static::buildPeriodNo($startTime, $no);

        return $periodNo;
    }

    /** 生成期号
     * @param $startTime
     * @param $rowNo
     * @return string
     */
    public static function buildPeriodNo($startTime, $rowNo)
    {
        $no = str_pad($rowNo, 5, 0, STR_PAD_LEFT);
        $startYear = 2010;
        $yearNum = date('Y', $startTime) - $startYear;
        $dateNum = date('md', $startTime);
        $periodNo = $yearNum . $dateNum . $no;

        return $periodNo;
    }

}
