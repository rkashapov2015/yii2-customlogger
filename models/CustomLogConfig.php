<?php

namespace rkashapov2015\customlogger\models;

use Yii;

/**
 * This is the model class for table "custom_log_config".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class CustomLogConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custom_log_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['key', 'required'],
            [['key','value'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'KEY',
            'value' => 'VALUE'
        ];
    }
}
