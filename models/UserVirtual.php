<?php

namespace app\models;

use Yii;
use app\helpers\DateFormat;
use app\services\User;
use yii\data\Pagination;

/**
 * 虚拟物品仓库
 */
class UserVirtual extends \yii\db\ActiveRecord
{
    const GET_CARD_KEY = "GET_CARD_"; //orderid
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_virtual';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'type','orderid','card','pwd','par_value'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => '用户id',
            'type' => '类型',
            'orderid' => '中奖订单号',
            'card' => '卡号',
            'pwd' => '密码',
            'par_value' => '面值'
        ];
    }

    public static function getList($get, $page = 1, $perpage = 10)
    {
        $query = UserVirtual::find();

        if(isset($get['startTime']) && $get['startTime']) $query->andWhere(['>=', 'create_time', strtotime($get['startTime'])]);
        if(isset($get['endTime']) && $get['endTime']) $query->andWhere(['<=', 'create_time', strtotime($get['endTime'])]);
        if(isset($get['account']) && $get['account']){
            $user = \app\models\User::find()->where('phone like "%'.$get['account'].'%" or email like "%'.$get['account'].'%"')->one();
            if($user['id']) $query->andWhere(['uid'=>$user['id']]);
            else $query->andWhere(['uid'=>0]);
        }
        if(isset($get['orderid']) && $get['orderid']) $query->andWhere(['orderid'=>$get['orderid']]);

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(),'page'=>$page - 1, 'defaultPageSize' =>$perpage ]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('id desc')
            ->all();

        return ['list'=>$list, 'totalCount'=>$pagination->totalCount];
    }

}
