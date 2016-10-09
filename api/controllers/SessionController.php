<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Session;
use yii\filters\Cors;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class SessionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Remove authentication filter, before the CORS Preflight requests and set it after the CORS filter
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    /**
     * Only for OPTIONS verb
     */
    public function actionOptions() 
    {
        Yii::$app->response->statusCode = 200;
    }
    
    /**
     * Returns all the sessions
     * @TODO: Change this method and the endpoint url to get the sessions from one event (using POST)
     * @return array
     */
    public function actionIndex() 
    {
        return Session::find()
                ->select([
                        'session.id', 'session.title AS title', 'unix_timestamp(session.starts) AS starts', 
                        'unix_timestamp(session.ends) AS ends', 'session.description', 
                        'event.title AS event', 'speaker.id AS speaker_id', 'speaker.full_name AS speaker_name'
                    ])
                ->leftJoin('event', 'session.event_id = event.id')
                ->leftJoin('speaker', 'session.id = speaker.session_id')
                ->asArray()
                ->all();
    }
}
