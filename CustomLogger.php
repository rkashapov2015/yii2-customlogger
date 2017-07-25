<?php

namespace rkashapov2015\customlogger;


use rkashapov2015\customlogger\behaviors\LogBehavior;

/**
 * Description of Bootstrap
 *
 * @author rinat
 */
class CustomLogger implements \yii\base\BootstrapInterface
{
    public $type = 2;
    public $url;
    public $excludeRoutes = [
        '/debug/'
    ];

    public function bootstrap($app)
    {
        $app->attachBehavior(
            'custom-logger',
            [
                'class' => LogBehavior::className(),
                'type' => $this->type,
                'url' => $this->url,
                'excludeRoutes' => $this->excludeRoutes
            ]
        );

    }

}
