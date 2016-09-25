<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Speaker;
use yii\filters\Cors;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class SpeakerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

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
     * Returns all the speakers
     * @TODO: Change this method and the endpoint url to get the speakers from one event (using POST)
     * @return array
     */
    public function actionIndex() 
    {
        return  Speaker::find()
                // ->select(['full_name', 'email', 'resume', 'id AS image_id', 'created_at', 'updated_at'])
                ->asArray()
                ->all();
    }
}
