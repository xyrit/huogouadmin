<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/29
 * Time: 19:01
 */

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\Query;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property integer $product_id
 * @property string $period_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $confirm
 * @property string $ship_area
 * @property string $ship_name
 * @property string $ship_addr
 * @property string $ship_zip
 * @property string $ship_email
 * @property string $ship_time
 * @property string $ship_mobile
 * @property integer $price
 * @property string $mark_text
 * @property integer $create_time
 * @property integer $last_modified
 */
class OrderTest extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'orders_test';
	}
}