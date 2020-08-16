<?php


namespace app\models;


use yii\db\ActiveRecord;

class Position  extends ActiveRecord
{

    public function rules()
    {
        return [
            [['product_id', 'quantity','order_id'], 'required'],
            [['product_id', 'quantity','order_id'], 'safe'],
            [['product_id','product_id','order_id'], 'integer']
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Product::className(), ['product_id' => 'id']);
    }

    public static function tableName()
    {
        return '{{position}}';
    }

}