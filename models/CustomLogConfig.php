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

    public static function setValueByKey($key, $value)
    {
        $keyCache = 'CustomLogConfig_' . $key;
        $model = static::findOne(['key' => $key]);
        if (!$model) {
            $model = new CustomLogConfig();
            $model->key = $key;
        }
        $model->value = $value;

        if ($model->save()) {
            \Yii::$app->cache->set($keyCache, $model, 7200);
            return true;
        }
        return false;
    }

    public static function getModelByKey($key)
    {
        $keyCache = 'CustomLogConfig_' . $key;
        if (false == $model = \Yii::$app->cache->get($keyCache)) {
            $model = static::findOne(['key' => $key]);
            if ($model) {
                \Yii::$app->cache->set($keyCache, $model, 7200);
            }
        }
        return $model;
    }

    public static function enableLogger()
    {
        static::setValueByKey('enable', '1');
    }

    public static function disableLogger()
    {
        static::setValueByKey('enable', '0');
    }

    public static function loggerIsEnabled()
    {
        $model = static::getModelByKey('enable');
        if ($model) {
            if ($model->value == '1') {
                return true;
            }
        }
        return false;
    }

    public static function getUrl()
    {
        $model = static::getModelByKey('url');
        if ($model) {
            return $model->value;
        }
        return '';
    }

    public static function setUrl($url)
    {
        return static::setValueByKey('url', $url);
    }

    public static function setExcludeRoutes($excludeRoutes)
    {
        $stringExcludeRoutes = implode(';', $excludeRoutes);
        static::setValueByKey('excludeRoutes', $stringExcludeRoutes);
    }

    public static function getExcludeRoutes()
    {
        $model = static::getModelByKey('excludeRoutes');
        if ($model) {
            return explode(';', $model->value);
        }
        return [];
    }

    public static function getType()
    {
        $model = static::getModelByKey('type');
        if ($model) {
            return intval($model->value);
        }
    }

    public static function setType($type)
    {
        return static::setValueByKey('type', $type);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $keyCache = 'CustomLogConfig_' . $this->key;
        if ($insert) {

        }


    }
}
