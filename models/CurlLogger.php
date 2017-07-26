<?php
/**
 * Created by PhpStorm.
 * User: rinat
 * Date: 25.07.17
 * Time: 10:45
 */

namespace rkashapov2015\customlogger\models;


class CurlLogger implements iLogger
{
    public $url;

    public function __construct($url = '')
    {
        $this->url = $url;
    }

    public function logProcessing($data)
    {
        if (!isset($data) || !is_array($data)) {
            return false;
        }
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            $out = curl_exec($curl);
            curl_close($curl);
            //$data = json_decode($out, true);
            //return $data;
            return true;
        }
        return false;

    }

}