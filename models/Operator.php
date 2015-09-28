<?php

namespace app\models;

use yii\db\ActiveRecord;

class Operator extends ActiveRecord
{
	public static function tableName()
    {
        return 'user';
    }
}