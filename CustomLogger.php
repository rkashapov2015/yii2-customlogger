<?php

namespace rkashapov2015\customlogger;


use rkashapov2015\customlogger\behaviors\LogBehavior;
/**
 * Description of Bootstrap
 *
 * @author rinat
 */
class CustomLogger implements \yii\base\BootstrapInterface {
    public $type;
    public $url;

    public function bootstrap($app) {
        $app->attachBehavior('custom-logger', [
            'class' => LogBehavior::className(),
            'type' => $this->type,
            'url' => $this->url
        ]);

    }

}
