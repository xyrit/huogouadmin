<?php

namespace app\models;

use Yii;
use app\helpers\StringHelper;
use app\helpers\TimeHelper;

/**
 * This is the model class for table "invite_friend".
 *
 * @property integer $id
 * @property string $user
 * @property integer $number
 * @property integer $status
 * @property integer $date
 * @property integer $uid
 */
class InviteFriend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite_friend'; //邀请好友表
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'number', 'date', 'uid'], 'required'],
            [['number', 'status', 'date', 'uid'], 'integer'],
            [['user'], 'string', 'max' => 100],
            [['uid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => '邀请的用户名',
            'number' => '邀请编号',
            'status' => '//消费状态,0代表没有参与云购',
            'date' => '//邀请时间',
            'uid' => '//邀请的用户ID',
        ];
    }
    
    public function friendList($where=null, $orderBy=null, $limit=null){
        
        return  $this->format(parent::findAll($where, $orderBy, $limit));
    }
    
    public function format($list){
       if(!StringHelper::isEmpty($list)) {
           foreach ($list as $key=>$value){
               $list[$key]['date'] = TimeHelper::showTime($value['date'],'Y-m-d H:i:s');
               if($value['status'] == 1){
                   $list[$key]['status'] = '已参与云购';
               }elseif ($value['status'] == 0){
                   $list[$key]['status'] = '未参与云购';
               }
           } 
       }else{
           return '';
       } 
       return $list;
      
    }
    


}
