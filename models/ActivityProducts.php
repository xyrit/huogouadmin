<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\helpers\MyRedis;
use app\models\PkCurrentPeriod;
/**
 * This is the model class for table "activity_products".
 *
 * @property string $id
 * @property string $bn
 * @property string $barcode
 * @property string $name
 * @property string $price
 * @property integer $face_value
 * @property integer $marketable
 * @property string $cost
 * @property string $cat_id
 * @property string $brand_id
 * @property integer $total
 * @property string $store
 * @property integer $allow_share
 * @property integer $is_recommend
 * @property integer $list_order
 * @property string $brief
 * @property string $intro
 * @property string $picture
 * @property string $created_at
 * @property string $updated_at
 * @property string $delivery_id
 * @property string $order_manage_gid
 * @property string $tag
 * @property string $keywords
 * @property integer $admin_id
 * @property string $live_time
 * @property integer $app
 * @property integer $display
 * @property integer $activity_id
 * @property integer $left_time
 * @property integer $is_virtual
 */
class ActivityProducts extends \yii\db\ActiveRecord
{

    const PK_PRODUCT_LOTTERY_TIME_KEY = 'PK_PRODUCT_LOTTERY_TIME_KEY';//开奖时间 hash

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_products';
    }

    public static $deliveries = [
        8 => '京东卡密',
        2 => '自建仓发货',

    ];

    public static $virtual_deliveries = [
        8 => '京东卡密',
    ];

    public static $activty_type = [
        1 => 'PK场',
    ];


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'cat_id', 'brand_id', 'picture', 'created_at', 'updated_at', 'order_manage_gid'], 'required'],
            [['is_virtual', 'left_time', 'price', 'face_value', 'marketable', 'cost', 'cat_id', 'brand_id', 'total', 'store', 'allow_share', 'is_recommend', 'list_order', 'created_at', 'updated_at', 'order_manage_gid', 'admin_id', 'live_time', 'app', 'display', 'activity_id'], 'integer'],
            [['intro'], 'string'],
            [['bn', 'name', 'brief', 'picture', 'tag', 'keywords'], 'string', 'max' => 255],
            [['barcode'], 'string', 'max' => 25],
            [['delivery_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

    }

    public static function getList($condition = '', $page = 1, $pageSize = 10)
    {
        $query = ActivityProducts::find()->leftJoin('current_periods as c', 'activity_products.id=c.product_id')->select(['activity_products.*', 'IFNULL(c.period_number, 0) as period_number']);
        if ($condition) {
            if ($condition['bn']) {
                $query->andWhere(['activity_products.bn' => $condition['bn']]);
            }
            if ($condition['name']) {
                $query->andWhere(['or', "activity_products.name like '%" . $condition['name'] . "%'", ['or', "tag like '%" . $condition['name'] . "%'"]]);
            }
            if ($condition['marketable'] != 'all') {
                $query->andWhere(['activity_products.marketable' => $condition['marketable']]);
            }
            if ($condition['allow_share'] != 'all') {
                $query->andWhere(['activity_products.allow_share' => $condition['allow_share']]);
            }
            if ($condition['cat_id']) {
                $catids = ProductCategory::children($condition['cat_id']);
                $catids = ArrayHelper::getColumn($catids, 'id');
                array_push($catids, $condition['cat_id']);
                $query->andWhere(['activity_products.cat_id' => $catids]);
            }
            if ($condition['sort'] && $condition['order']) {
                if ($condition['sort'] == 'period_number') {
                    $query->orderBy('c.' . $condition['sort'] . ' ' . $condition['order']);
                } else {
                    $query->orderBy('activity_products.' . $condition['sort'] . ' ' . $condition['order']);
                }
            }
        }

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
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
                    $currenPeriod = PkCurrentPeriod::findOne(['product_id' => $productId]);
                    if (!$currenPeriod) {
                        $conn = Yii::$app->db;
                        //增加期数
                        $command = $conn->createCommand("select period_number from pk_periods where product_id = {$productId} order by id desc");
                        $period = $command->queryOne();
                        self::initCurrentPeriodInfo($productModel, $period['period_number'] + 1);
                    }
                }
            } else {
//                $currenPeriod = PkCurrentPeriod::findOne(['product_id' => $productId]);
//                if ($currenPeriod && $currenPeriod['sales_num'] == 0) {
//                    $currenPeriod->delete();
//                }
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
        $currentPeriod = PkCurrentPeriod::findOne(['product_id' => $productModel->id]);

        if (!$currentPeriod) {
            $startTime = time();
            $endTime = time() + $productModel['left_time'] * 60;
            $currentPeriod = new PkCurrentPeriod();
            $currentPeriod->table_id = mt_rand(100, 109);
            $currentPeriod->product_id = $productModel->id;
            $currentPeriod->price = $productModel->price;
            $currentPeriod->period_number = $period_numer;
            $currentPeriod->start_time = $startTime;
            $currentPeriod->end_time = $endTime;
            $currentPeriod->save(false);

            $currentPeriod->period_no = static::getPeriodNo($currentPeriod);
            $currentPeriod->save(false);
            $curPeriodId = $currentPeriod->id;
            $redis = new MyRedis();
            $redis->hset(static::PK_PRODUCT_LOTTERY_TIME_KEY, [$curPeriodId=>$endTime]);
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
        $productId = $period['product_id'];
        $date = date('Y-m-d', intval($startTime));
        $start = strtotime($date);
        $end = $start + 3600*24;
        $sql = "select rowno,id,start_time from (select (@rowno:=@rowno+1) as rowno,a.* from ( select * from ((select id,start_time from pk_periods where product_id = '".$productId."' and start_time > '".$start."' and start_time < '".$end."' order by start_time asc) union all (select id,start_time from pk_current_periods where product_id = '".$productId."' and start_time > '".$start."' and start_time < '".$end."' order by start_time asc ) ) as k order by k.start_time asc) as a ,(select @rowno:=0) t) as b where b.id=".$periodId;
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
        $periodNo = 'PK' . $yearNum . $dateNum . $no;

        return $periodNo;
    }


}
