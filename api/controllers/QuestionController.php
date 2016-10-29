<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Question;
use yii\filters\Cors;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class QuestionController extends Controller
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
     * Returns all questions of one session
     * @param int $id Session id
     * @return array
     */
    public function actionSession($id) 
    {
        return Question::find()
                ->select([
                        'question.id', 'user.full_name AS user_name', 'question.question', 'question.status',
                        'question.created_at', 'question.updated_at'
                    ])
                ->leftJoin('user', 'question.user_id = user.id')
                ->where('question.session_id = :session', [':session' => $id])
                ->asArray()
                ->all();
    }
}
