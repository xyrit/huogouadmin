<?php

	namespace app\models;

	use Yii;
	use yii\data\Pagination;

	/**
	* 用户优惠券
	*/
	class UserCoupons extends \yii\db\ActiveRecord
	{
		
		public static function tableName()
		{
			return 'user_coupons';
		}

		public function rules()
	    {
	        return [
	            [['user_id', 'coupon_id', 'code', 'status', 'receive_time','used_time'], 'required'],
	            [['user_id', 'coupon_id'], 'integer']
	        ];
	    }

	    public function attributeLabels(){
	    	return [
	    		'ID' => 'ID',
	    		'user_id' => '用户ID',
	    		'coupon_id' => '优惠券ID',
	    		'code' => '优惠券码',
	    		'status' => '状态',
	    		'receive_time' => '领取时间',
	    		'used_time' => '使用时间'
	    	];
	    }

	    /**
	     * 获取用户所有优惠券
	     * @param  int $uid     用户ID
	     * @param  int $page    页数
	     * @param  int $perpage 每页数量
	     * @return [type]          [description]
	     */
	    public static function getUserCoupons($uid,$page,$perpage = '20',$where)
	    {
	    	$query = UserCoupons::find()->where(['user_id' => $uid]);
	    	if ($where) {
	    		$query = $query->andwhere($where);
	    	}
	    	$query = $query->orderBy('receive_time desc,id desc');
	        $pages = new Pagination(['defaultPageSize' => $perpage, 'totalCount' => $query->count(), 'page' => $page - 1]);

	        $list = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

	        return ['list' => $list, 'total' => $pages->totalCount];
	    }

	    /**
	     * 获取用户所有有效优惠券
	     * @param  int $uid 用户ID
	     * @return [type]      [description]
	     */
	    public static function getValidCoupons($uid)
	    {
	    	return UserCoupons::find()->where(['user_id'=>$uid,'status'=>0])->asArray()->all();
	    }

	    /**
	     * 获取用户优惠券信息
	     * @param  string $code 优惠券码
	     * @return [type]       [description]
	     */
	    public static function getUserCouponByCode($uid,$code)
	    {
	    	return UserCoupons::find()->where(['user_id'=>$uid,'code'=>$code])->asArray()->one();
	    }

	    /**
	     * 获取用户的优惠券
	     * @param  array $userCouponId 用户的优惠券ID
	     * @return [type]               [description]
	     */
	    public static function getCodeInfo($userCouponId)
	    {
	    	return UserCoupons::find()->where(['in','id',$userCouponId])->asArray()->all();
	    }

	    public static function getUserCouponById($id)
	    {
	    	return UserCoupons::find()->where(['id'=>$id])->asArray()->one();
	    }
	}