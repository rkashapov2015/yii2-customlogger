<?php
/**
 * Created by PhpStorm.
 * User: rinat
 * Date: 25.07.17
 * Time: 10:06
 */

namespace rkashapov2015\customlogger\models;


class LogFactory
{
    const TYPE_CURL = 1;
    const TYPE_DB = 2;
    public $type;
    public $url;


    function __construct($type = LogFactory::TYPE_DB,$url = '')
    {
        $this->type = $type;
        $this->url = $url;
    }

    public function getLogger()
    {
        switch ($this->type) {
            case LogFactory::TYPE_CURL:
                return new CurlLogger($this->url);
                break;
            case LogFactory::TYPE_DB:
                return new DbLogger;
                break;
            default:

                break;
        }
    }
}