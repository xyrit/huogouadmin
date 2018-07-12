<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\data\Pagination;
use app\validators\MobileValidator;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $real_name
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property integer $avatar
 * @property string $password_reset_token
 * @property integer $role
 * @property integer $privilege
 * @property integer $super
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $login_at
 * @property string $login_ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_NORMAL = 0;
    const STATUS_FREEZE = 1;
    const STATUS_DEL = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'role', 'real_name', 'password', 'email', 'status'], 'required'],
            [['avatar', 'role', 'super', 'created_at', 'login_at', 'updated_at', 'status'], 'integer'],
            [['login_ip'], 'string'],
            [['username', 'real_name'], 'string', 'max' => 20],
            [['job_number', 'department'], 'string', 'max' => 50],
            [['password', 'email', 'password_reset_token'], 'string', 'max' => 255],
            [['privilege'], 'string', 'max' => 1024],
            [['phone'], 'string', 'max' => 11],
            ['email', 'checkEmail', 'on'=>'add'],
            ['phone', 'checkPhone', 'on'=>'add'],
            ['username', 'checkUsername', 'on'=>'add'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_number' => '工号',
            'real_name' => '姓名',
            'username' => '用户名',
            'password' => '密码',
            'department' => '部门',
            'phone' => '联系方式',
            'email' => '邮箱',
            'role' => '角色',
            'privilege' => '权限',
            'status' => '是否启用',
            'created_at' => 'Created At',
            'updated_at' => '更新时间',
            'login_at' => '最近登录时间',
            'login_ip' => '最近登录ip',
        ];
    }

    public function checkEmail($attribute)
    {
        $emailValidator = new EmailValidator();
        $valid = $emailValidator->validate($this->email);
        if ($valid) {
            $user = Admin::findOne(['email'=>$this->email]);
            if ($user) {
                $this->addError($attribute, '邮箱已存在.');
            }
            return;
        }
        $this->addError($attribute, '请输入正确的邮箱地址.');
    }

    public function checkPhone($attribute)
    {
        $mobileValidator = new MobileValidator();
        $valid = $mobileValidator->validate($this->phone);
        if ($valid) {
            $user = Admin::findOne(['phone'=>$this->phone]);
            if ($user) {
                $this->addError($attribute, '手机已存在.');
            }
            return;
        }
        $this->addError($attribute, '请输入正确的手机.');
    }

    public function checkUsername($attribute)
    {
        $user = Admin::findOne(['username'=>$this->username]);
        if ($user) {
            $this->addError($attribute, '用户名已存在.');
        }
        return;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return \app\models\AdminUser |null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 0]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return \app\models\AdminUser|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return 'admin_auth_key_' . $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function getList($condition = '', $page = 1, $pageSize = 10)
    {
        $query = Admin::find();
        if ($condition) {
            if ($condition['account']) {
                $query->andWhere(['or', ['like', 'job_number', $condition['account']], ['like', 'real_name', $condition['account']], ['like', 'username', $condition['account']]]);
            }
            if ($condition['role']) {
                $query->andWhere(['role' => $condition['role']]);
            }
            if ($condition['status'] != 'all') {
                $query->andWhere(['status' => $condition['status']]);
            }
        }
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $list = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();

        return ['rows'=>$list, 'total'=>$pagination->totalCount];
    }

    public static function getEmployeeName()
    {
        $all = Admin::find()->all();
        return ArrayHelper::map($all, 'id', 'real_name');
    }
}
