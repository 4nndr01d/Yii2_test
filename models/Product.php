<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{


    public function rules()
    {
        return [
            [['name', 'price', 'available_quantity'], 'required'],
            [['name', 'price', 'available_quantity'], 'safe'],
            [['price','available_quantity'], 'integer'],
            [['name'], 'string'],
        ];
    }


    public static function tableName()
    {
        return '{{product}}';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

}