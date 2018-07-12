<?php

namespace app\models;

use Yii;
use app\models\Image;

/**
 * This is the model class for table "banners".
 *
 * @property string $id
 * @property string $name
 * @property integer $from
 * @property string $starttime
 * @property string $endtime
 * @property string $picture
 * @property string $link
 * @property integer $type
 * @property string $width
 * @property string $height
 * @property integer $list_order
 * @property string $created_at
 * @property string $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'required'],
            [[ 'type', 'width', 'height', 'list_order', 'created_at', 'updated_at',  'source',  'from'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['picture'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'picture' => '图片',
            'link' => '链接地址',
            'type' => '类型',
            'width' => '宽度',
            'height' => '高度',
            'source' => '终端',
            'list_order' => '排序',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * 获取banner
     * @param source  版本
     * @param type  位置
     * @param num 显示张数
     * return arr
     */
    public static function bannerList($source = 0, $type = 0, $num = 3)
    {
        $where['type'] = $type;
        $where['source'] = $source;
        $order = 'list_order,id desc';
        $list = Banner::find()->where($where)->orderBy($order)->limit($num)->asArray()->all();
        $arr = [];
        foreach($list as $key => $val){
            $eq = time() - $val['starttime'];
            $lt = $val['endtime'] - time();
            if(($eq >= 0 && $lt >= 0) || ($val['starttime'] == 0 && $val['endtime'] == 0) ){
                $arr[$key] = $val;
                $arr[$key]['picture'] = Image::getBannerInfoUrl($val['picture'], 'big');
            }
        }
        return $arr;
    }

    public static function getSource($source)
    {
        switch ($source) {
            case '0':
                return 'pc';
                break;
            case '1':
                return '微信';
                break;
            case '2':
                return '安卓';
                break;
            case '3':
                return 'ios';
                break;
            case '4':
                return 'wap';
                break;
            default:
                return 'pc';
                break;
        }
    }
}
