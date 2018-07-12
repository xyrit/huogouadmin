<?php

namespace app\models;

use Yii;
use app\helpers\TimeHelper;
use app\helpers\StringHelper;
use app\services\Invite;
/**
 * This is the model class for table "invite_apply".
 *
 * @property integer $id
 * @property integer $money
 * @property string $user
 * @property string $bank
 * @property string $branch
 * @property string $phone
 * @property string $bank_number
 * @property integer $Renew
 * @property integer $status
 * @property integer $data
 * @property integer $uid
 */
class InviteApply extends \yii\db\ActiveRecord  
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite_apply'; //提现申请表
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'user', 'bank', 'branch', 'phone', 'bank_number', 'date', 'uid'], 'required'],
            [['renew', 'status', 'date', 'uid'], 'integer'],
            [['money'], 'number','message'=>'提现金额为正整数或带两位小数'],
            ['money', function ($attribute, $params) {
                if ($this->$attribute > Invite::getBalance()) {
                    $this->addError($attribute, '输入额超出可提现金额');
                }elseif (strlen($this->$attribute)<3){
                    $this->addError($attribute, '佣金满100元才可提现');
                }
            }],
            [['money'], 'string', 'min' => 3, 'max' => 9],
            [['user'], 'string', 'max' => 20],
            [['bank'], 'string', 'max' => 40],
            [['branch'], 'string', 'max' => 100],
            [['phone','bank_number'], 'number'],
            [['phone'], 'string','min' => 11, 'max' => 11],
            [['bank_number'], 'string','min' => 16, 'max' => 19],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'money' => '申请提现金额',
            'user' => '开  户 人',
            'bank' => '银行名称',
            'branch' => '开户支行',
            'phone' => '联系电话',
            'bank_number' => '银行账号',
            'Renew' => '手续费(元)',
            'status' => '审核状态,0表示未审核',
            'date' => '申请时间',
            'uid' => '申请用户ID',
        ];
    }
    
    public function scenarios()
    {
        $parent = parent::scenarios();
        $parent['add'] = ['money','user','bank','branch','bank_number','phone'];
        return $parent;
    }
    
    
    /**
     * 提现申请
     */
    public static function apply($model,$params=array()){
       isset($params['money']) && $model->money = $params['money'];
       isset($params['user']) && $model->user = $params['user'];
       isset($params['bank']) && $model->bank = $params['bank'];
       isset($params['branch']) && $model->branch = $params['branch'];
       isset($params['bank_number']) && $model->bank_number = $params['bank_number'];
       isset($params['phone']) && $model->phone = $params['phone'];
       $model->date = time();
       $model->uid = Yii::$app->user->id;
       
       
       if ($model->validate()) {           
            if (!$model->save()) {
               return false;
            }
        } else {
               return false;
        }
        
      return true;

   }
   
   /**
    * 提现记录
    */
   public static function mentionList(){
       
     $list = self::find()->where(['uid'=>\Yii::$app->user->id])->orderBy(['date'=>'SORT_DESC'])->asArray()->all();   
     foreach ($list as $key=>$value){
         $list[$key]['date'] = date($value['date'],'Y-m-d H:i:s');
         $list[$key]['status'] = ($value['status'] == 0) ? '未审核' : '已审核';
         
     }
     return  $list;
    
   }
   
   /**
    * 用户提现总和
    */
   public static function moneySum($status=0){
       
      $query = self::find();
      $query->select('money')->where(['uid'=>\Yii::$app->user->id]);
      if(!empty($status)){
          $query->andWhere(['status'=>1]);
      }
      return  $query->sum('money');

   }
   

}
