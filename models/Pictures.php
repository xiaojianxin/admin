<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pictures".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $type
 */
class Pictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'type'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 100]
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
            'url' => 'Url',
            'type' => 'Type',
        ];
    }
}

