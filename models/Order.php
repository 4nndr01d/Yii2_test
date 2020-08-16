<?php


namespace app\models;


use yii\db\ActiveRecord;

class Order  extends ActiveRecord
{
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'default', 'value'=>date('Y-m-d h:i:s')],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public static function tableName()
    {
        return '{{order}}';
    }

    public static function primaryKey()
    {
        return ['id'];
    }
}