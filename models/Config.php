<?php

	namespace app\models;

	use Yii;

	/**
	* 配置
	*/
	class Config extends \yii\db\ActiveRecord
	{
		const CONFIG_KEY = 'CONFIG';
		
		public static function tableName()
		{
			return 'config';
		}

		public function rules()
	    {
	        return [
	            [['key', 'value'], 'required'],
	        ];
	    }

	    /**
	     * @inheritdoc
	     */
	    public function attributeLabels()
	    {
	        return [
	            'id' => 'ID',
	            'key' => 'Key',
	            'value' => 'Value',
	        ];
	    }

		public static function getValueByKey($key)
		{
			$data = Config::find()->where(['key'=>$key])->asArray()->one();
			return json_decode($data['value'],true);
		}
	}