<?php

namespace app\models;

use Yii;
use app\helpers\TimeHelper;
use app\services\Invite;
/**
 * This is the model class for table "invite_recharge".
 *
 * @property integer $id
 * @property integer $money
 * @property integer $type
 * @property integer $uid
 * @property integer $date
 */
class InviteRecharge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite_recharge';  //充值表(拥金/充值卡)
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'money', 'uid', 'date'], 'required'],
            [['id', 'money', 'type', 'uid', 'date'], 'integer'],
            [['money'], 'number','message'=>'充值金额为正整数'],
            ['money', function ($attribute, $params) {
                if ($this->$attribute > Invite::getBalance()) {
                    $this->addError($attribute, '输入额超出可充值金额');
                }elseif (Invite::getBalance()<1){
                    $this->addError($attribute, '佣金余额满1元才可充值');
                }
            }],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'money' => '充值金额(元)',
            'type' => '充值类型0[拥金充值]1[充值卡充值]',
            'uid' => '充值用户',
            'date' => '充值时间',
        ];
    }
    
    public function scenarios()
    {
        $parent = parent::scenarios();
        $parent['add'] = ['money'];
        return $parent;
    }
    
    /**
     * 拥金充值
     */
    public static  function recharge($model,$params=array()){

        isset($params['money']) && $model->money = intval($params['money']);
        $model->date = time();
        $model->uid = Yii::$app->user->id;
        
        if(!is_numeric($params['money'])){
            $return['repose'] = '请输入数字';
            return $return;
        }elseif(Invite::getBalance()<1){
            $return['repose'] = '佣金余额满1元才可充值';
            return $return;
        }elseif (intval($params['money']) > Invite::getBalance()){
            $return['repose'] = '输入额超出可充值金额';
            return $return;
        }else{
            if (!$model->save()) {
                $return['repose'] = '充值失败';
            }
            $return['repose'] = 'succ';
            return $return;
        } 

    }
  
    
    
    /**
     * 用户拥金/充值卡充值总和
     * 
     */
    public static function moneySum($type=0){
         
        $query = self::find();
        $query->select('money')->where(['uid'=>\Yii::$app->user->id]);
        if(!empty($type)){
            $query->andWhere(['$type'=>1]);
        }
        return  $query->sum('money');
    
    }
    
}