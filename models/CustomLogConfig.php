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
            [['key', 'value'], 'string']
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

    public static function changeValueByKey($key, $value)
    {
        $model = static::findOne(['key' => $key]);
        if (!$model) {
            $model = new CustomLogConfig();

        }
        $model->key = $key;
        $model->value = $value;
        return $model->save();
    }

    public static function enableLogger()
    {
        static::changeValueByKey('enable', '1');
    }

    public static function disableLogger()
    {
        static::changeValueByKey('enable', '0');
    }

    public static function setUrl($url)
    {
        static::changeValueByKey('url', $url);
    }

    public static function getExcludeRoutes()
    {
        $keyCache = 'CustomLogConfig_excludeRoutes';
        if (false == $model = \Yii::$app->cache->get($keyCache)) {
            $model = static::findOne(['key' => 'excludeRoutes']);
            if ($model) {
                \Yii::$app->cache->set($keyCache, $model, 7200);
            }
        }
        return $model;
    }

    public static function setExcludeRoutes($excludeRoutes)
    {
        $stringExcludeRoutes = implode(';', $excludeRoutes);
        static::changeValueByKey('excludeRoutes', $stringExcludeRoutes);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $keyCache = 'CustomLogConfig_' . $this->key;
        if ($insert) {

        }

        \Yii::$app->cache->set($keyCache, $this, 7200);
    }
}
