<?php
/**
 * Created by PhpStorm.
 * User: rinat
 * Date: 25.07.17
 * Time: 10:40
 */

namespace rkashapov2015\customlogger\models;


class DbLogger implements iLogger
{
    public function logProcessing($data)
    {
        if (isset($data) && is_array($data)) {
            $customLog = new CustomLog();
            if (isset($data['created_at'])) {
                unset ($data['created_at']);
            }
            foreach ($data as $key => $value) {
                if ($customLog->hasAttribute($key)) {
                    $customLog->$key = $value;
                }
            }
            if ($customLog->save()) {
                return true;
            } else {
                \Yii::error(json_encode($customLog->getErrors()));
            }
        }
        return false;
    }
}