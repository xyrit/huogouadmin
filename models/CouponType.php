<?php 

	namespace app\models;

	use Yii;

	class CouponType extends \yii\db\ActiveRecord{

		public static function tableName()
		{
			return "coupon_type";
		}

		public function rules()
		{
			return [
	            [['name','desc'], 'required'],
	        ];
		}

		public function attributeLabels()
		{
			return [
				'name' => '名称',
				'desc' => '描述'
			];
		}

		public static function getList()
		{
			$_list = CouponType::find()->asArray()->all();
			$list = array();

			foreach ($_list as $key => $value) {
				$list[$value['id']] = $value;
			}

			return $list;
		}

		public static function getInfo($id)
		{
			return CouponType::find()->where(['id'=>$id])->asArray()->one();
		}
	}