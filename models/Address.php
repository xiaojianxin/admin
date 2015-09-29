<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Order;

class Address extends ActiveRecord
{
	public function getOrders()
    {
        //同样第一个参数指定关联的子表模型类名
        //
        return $this->hasMany(Order::className(),['addressid'=>'id']);
    }

}
