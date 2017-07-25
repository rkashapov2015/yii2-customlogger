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
            foreach ($data as $key => $value) {
                if (property_exists(CustomLog::class, $key)) {
                    $customLog->$key = $value;
                }
            }
            if ($customLog->save()) {
                return true;
            }
        }
        return false;
    }
}