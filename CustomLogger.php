<?php

namespace rkashapov2015\customlogger;


use rkashapov2015\customlogger\behaviors\LogBehavior;
use rkashapov2015\customlogger\models\LogFactory;

/**
 * Description of Bootstrap
 *
 * @author rinat
 */
class CustomLogger implements \yii\base\BootstrapInterface
{
    public $type = LogFactory::TYPE_DB;
    public $url;
    public $excludeRoutes = [
        '/debug/*'
    ];
    public $useIpGeoBase = false;

    public function bootstrap($app)
    {
        $app->attachBehavior(
            'custom-logger',
            [
                'class' => LogBehavior::className(),
                'type' => $this->type,
                'url' => $this->url,
                'excludeRoutes' => $this->excludeRoutes,
                'useIpGeoBase' => $this->useIpGeoBase
            ]
        );

    }

}
