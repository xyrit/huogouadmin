<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "act_lottery_configuration".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $start_time
 * @property string $end_time
 * @property string $validity_start
 * @property string $validity_end
 * @property string $content
 * @property string $url
 * @property string $introduce
 * @property integer $consume
 * @property string $created_at
 */
class Lottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_lottery_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at'], 'required'],
            [['status', 'start_time', 'end_time', 'validity_start', 'validity_end', 'consume', 'created_at'], 'integer'],
            [['name', 'url'], 'string', 'max' => 100],
            [['content', 'introduce'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'validity_start' => 'Validity Start',
            'validity_end' => 'Validity End',
            'content' => 'Content',
            'url' => 'Url',
            'introduce' => 'Introduce',
            'consume' => 'Consume',
            'created_at' => 'Created At',
        ];
    }

    public static function getList($page, $pageSize = 20){
        $query = Lottery::find();

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pagination = new Pagination(['totalCount' => $totalCount, 'page' => $page - 1, 'defaultPageSize' => $pageSize]);
        $result = $query->orderBy('id desc')->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();

        $return['rows'] = $result;
        $return['total'] = $totalCount;
        return $return;
    }

    public static function createLogTable($tableId)
    {
        $table = 'act_lottery_log_'.$tableId;
        $conn = Yii::$app->db;
        $conn->createCommand('DROP TABLE IF EXISTS `'.$table.'`;')->execute();
        $sql = "CREATE TABLE `".$table."` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` INT(10) UNSIGNED NOT NULL COMMENT '抽奖用户',
  `activity_id` INT(10) UNSIGNED DEFAULT 0 COMMENT '活动id',
  `reward_id` INT(10) UNSIGNED NOT NULL COMMENT '奖品id',
  `status` TINYINT(1) DEFAULT 0 COMMENT '0未中奖，1已中奖',
  `created_at` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`activity_id`),
  KEY (`reward_id`),
  KEY (`user_id`)
)ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='抽奖记录';";
        $conn->createCommand($sql)->query();
    }
}
