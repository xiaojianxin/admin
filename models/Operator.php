<?php

namespace app\models;
use app\models\Address;
use app\models\Order;

use yii\db\ActiveRecord;

class Operator extends ActiveRecord
{
	public static function tableName()
    {
        return 'user';
    }

    public function getOrders($id)
    {
        //同样第一个参数指定关联的子表模型类名
        //
        return $this->hasMany(Order::className(),['id'=>'userid']);
    }

}