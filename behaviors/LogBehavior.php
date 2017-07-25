<?php

namespace rkashapov2015\customlogger\behaviors;

use Yii;
use yii\base\Application;
use yii\web\Application as WebApp;
use yii\base\Behavior;
use rkashapov2015\customlogger\models\LogFactory;

/**
 * Description of LogBehavior
 *
 * @author rinat
 */
class LogBehavior extends Behavior
{

    public $type;
    public $url;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [Application::EVENT_AFTER_REQUEST => 'afterRequest'];
    }


    public function afterRequest($event)
    {
        $isWebApp = Yii::$app instanceof \yii\web\Application;
        if (!$isWebApp) {
            return true;
        }

        $logFactory = new LogFactory($this->type, $this->url);

        $logFactory->getLogger()->logProcessing($this->dataCollection());
    }

    /**
     * Сбор данных
     * @return array|bool
     */
    public function dataCollection()
    {
        $remote_ip = Yii::$app->request->userIP;

        $data = [];
        $data['agent'] = Yii::$app->request->userAgent;
        $data['ip'] = Yii::$app->request->userIP;
        $data['url'] = Yii::$app->request->getUrl();
        $matches = null;
        $returnValue = preg_match('/debug\\/default\\/toolbar/', $data['url'], $matches);
        if ($matches) {
            return true;
        }
        $data['request_method'] = Yii::$app->request->method;

        //user_id
        if (!Yii::$app->user->isGuest) {
            $data['user_id'] = Yii::$app->user->id;
        }

        //status
        $data['status'] = filter_input(INPUT_SERVER, 'REDIRECT_STATUS');

        //GET POST params
        $params = [];
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
        }
        if (Yii::$app->request->isGet) {
            $params = Yii::$app->request->get();
        }
        $data['params'] = json_encode($params);

        //geo data by ip
        if (isset(Yii::$app->ipgeobase)) {
            $geo_data_ip = Yii::$app->ipgeobase->getLocation($remote_ip);
            $data['country'] = isset($geo_data_ip['country']) ? $geo_data_ip['country'] : null;
            $data['city'] = isset($geo_data_ip['city']) ? $geo_data_ip['city'] : null;
            $data['lat'] = isset($geo_data_ip['lat']) ? $geo_data_ip['lat'] : null;
            $data['lng'] = isset($geo_data_ip['lng']) ? $geo_data_ip['lng'] : null;
        }
        return $data;
    }
}
