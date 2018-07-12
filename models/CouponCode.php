<?php
	namespace app\models;

	use Yii;
	use yii\data\Pagination;

	class CouponCode extends \yii\db\ActiveRecord{

		public static function tableName()
		{
			return 'coupon_code';
		}

		public function rules()
	    {
	        return [
	            [['coupon_id','code'], 'required'],
	        ];
	    }

	    public function attributeLabels()
	    {
	        return [
	            'id' => 'ID',
	            'coupon_id' => '优惠券ID',
	            'code' => '优惠券码',
	            'status' => '状态',
	            'user_id' => '领取人ID',
	            'receive_time' => '领取时间',
	            'used_time' => '使用时间'
	        ];
	    }

	    /**
	     * 生成优惠券码
	     * @param  integer  $couponId 优惠券id
	     * @param  integer  $nums     生成数量
	     * @param  integer $back     是否返回生成的码
	     * @return [type]            [description]
	     */
	    public static function makeCode($couponId,$nums,$back = 0)
	    {	
	    	$codeList = array();
	    	$db = \Yii::$app->db;
	    	$couponCodeField = ['coupon_id','code'];
	    	$insertCodes = array();
	    	for ($j=1; $j <= $nums; $j++) {
		    	$code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
		        $rand = $code[rand(0,25)].$couponId.strtoupper(dechex(date('m'))).date('d').substr(time(),-5).substr(microtime(),2,5).sprintf('%02d',rand(0,99999));
		        $str1 = md5( $rand, true );
		        $str2 = '0123456789ABCDEFGHIJKLMNOPQRSTUV';
		        $code = '';
		        for($f = 0;$f < 10;$f++){
		        	$g = ord( $str1[ $f ] );
		            $code .= $str2[ ( $g ^ ord( $str1[ $f + 6 ] ) ) - $g & 0x1F ];
		        }
		        $codeList[$j] = $code;
		        $insertCodes[] = array($couponId,$code);
		        if ( ($nums < 10000 && $nums == $j) || $j == 10000) {
		        	$db->createCommand()->batchInsert(self::tableName(),$couponCodeField,$insertCodes)->execute();
		        	$insertCodes = array();
		        }
	    	}
	    	if ($back) {
                return $codeList;
            }else{
                return count($codeList);
            }
	    }


	    /**
	     * 冻结优惠券
	     * @param  [int] $cid  优惠券id
	     * @param  [int] $nums 冻结张数
	     * @return [type]       [description]
	     */
	    public static function freeze($cid,$nums,$packetId)
	    {
	    	$db = \Yii::$app->db;
	    	$sql = 'select min(id) as min,max(id) as max from (select id from coupon_code where status = 0 and coupon_id = '.$cid;
	    	if ($nums > 0) {
	    		$sql .= ' limit '.$nums;
	    	}
	    	$sql .= ' )a';
	    	$range = $db->createCommand($sql)->queryOne();
	    	$count = CouponCode::updateAll(['status'=>5,'packet_id'=>$packetId],['between','id',$range['min'],$range['max']]);
	    	echo $count;
	    	return $count;
	    }
	}