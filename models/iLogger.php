<?php
/**
 * Created by PhpStorm.
 * User: rinat
 * Date: 25.07.17
 * Time: 10:14
 */

namespace rkashapov2015\customlogger\models;


interface iLogger
{
    public function logProcessing($data);
}