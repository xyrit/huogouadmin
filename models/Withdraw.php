<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "withdraw".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $money
 * @property string $account
 * @property string $bank
 * @property string $branch
 * @property string $phone
 * @property string $bank_number
 * @property integer $status
 * @property integer $payment
 * @property string $payment_no
 * @property integer $payment_money
 * @property integer $apply_time
 * @property integer $audit_time
 * @property integer $pass_time
 * @property integer $audit_user
 * @property integer $pass_user
 * @property integer $fail_reason
 */
class Withdraw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdraw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'money', 'account', 'bank', 'branch', 'phone', 'bank_number'], 'required'],
            [['user_id', 'money', 'status', 'payment', 'payment_money', 'apply_time', 'audit_time', 'pass_time', 'audit_user', 'pass_user'], 'integer'],
            [['account'], 'string', 'max' => 20],
            [['bank'], 'string', 'max' => 40],
            [['branch', 'payment_no'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 11],
            [['bank_number'], 'string', 'max' => 30],
            [['money'], 'compare', 'compareValue' => 100, 'operator'=>'>='],
            [['phone'], '\app\validators\MobileValidator', 'message'=>'请输入正确的手机号'],
            [['money'], 'checkMoney'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'money' => '提现金额',
            'account' => '开户人',
            'bank' => '银行名称',
            'branch' => '开户支行',
            'phone' => '联系电话',
            'bank_number' => '银行帐号',
            'status' => 'Status',
            'payment' => 'Payment',
            'payment_no' => 'Payment No',
            'payment_money' => 'Payment Money',
            'apply_time' => 'Apply Time',
            'audit_time' => 'Audit Time',
            'pass_time' => 'Pass Time',
            'audit_user' => 'Audit User',
            'pass_user' => 'Pass User',
            'fail_type' => 'Fail Type',
        ];
    }

    public function checkMoney()
    {
        $user = User::findOne($this->user_id);
        if ($user['commission'] < $this->money * 100) {
            $this->addError("money", "佣金余额不足");
        }
    }

    public static function getList($condition, $page, $pageSize)
    {
        $query = Withdraw::find()->leftJoin('users', 'withdraw.user_id = users.id')->select(['withdraw.*', 'users.phone as user_phone', 'users.email']);

        if (isset($condition['startTime']) && isset($condition['endTime']) && $condition['startTime'] && $condition['endTime']) {
            $query->andWhere(['between', 'withdraw.apply_time', strtotime($condition['startTime']), strtotime($condition['endTime'])]);
        }
        if (isset($condition['account']) && $condition['account']) {
            $query->andWhere(['or', 'users.phone="' . $condition['account'] . '"', 'users.email="' . $condition['account'] . '"']);
        }
        if (isset($condition['status']) && $condition['status'] != 'all') {
            $query->andWhere(['withdraw.status' => $condition['status']]);
        }

        $order = 'withdraw.apply_time DESC';
        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy($order)->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $admin = Admin::find()->indexBy('id')->asArray()->all();

        foreach ($result as &$one) {
            $one['audit_user_name'] = isset($admin[$one['audit_user']]) ? $admin[$one['audit_user']]['username'] : '';
            $one['pass_user_name'] = isset($admin[$one['pass_user']]) ? $admin[$one['pass_user']]['username'] : '';
        }

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }
}
