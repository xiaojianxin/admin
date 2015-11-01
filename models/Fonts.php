<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonts".
 *
 * @property integer $id
 * @property string $ttfurl
 * @property string $name
 */
class Fonts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fonts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ttfurl', 'name'], 'required'],
            [['ttfurl'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ttfurl' => 'Ttfurl',
            'name' => 'Name',
        ];
    }
}
