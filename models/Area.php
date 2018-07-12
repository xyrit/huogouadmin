<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "areas".
 *
 * @property integer $Id
 * @property string $Name
 * @property integer $Pid
 *
 * @property Area $p
 * @property Area[] $areas
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'pid'], 'integer'],
            [['name'], 'string', 'max' => 40]
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
            'pid' => 'Pid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return $this->hasOne(Area::className(), ['id' => 'Pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreas()
    {
        return $this->hasMany(Area::className(), ['Pid' => 'Id']);
    }

    public static function getAddressArea($pro_id, $city_id, $area_id){
        $pro = Area::findOne($pro_id);
        $city = Area::findOne($city_id);
        $area = Area::findOne($area_id);
        $city['name'] = isset($city) ? $city['name'] : '';
        $area['name'] = isset($area) ? $area['name'] : '';
        return $pro['name']." ".$city['name']." ".$area['name'];
    }
}
