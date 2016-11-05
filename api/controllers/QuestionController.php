<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use common\models\Question;
use yii\filters\Cors;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;

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
        
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['options', 'index'],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['options'],
                    'verbs' => ['OPTIONS'],
                    'allow' => true,
                ],
                [
                    'actions' => ['index'],
                    'allow' => true,
                ],
                [
                    'actions' => ['create'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
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
    public function actionIndex($id) 
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
    
    /**
     * Creates a new question
     * @return Array message or validation errors
     */
    public function actionCreate()
    {
        $model = new Question();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->user_id = Yii::$app->user->id;
        
        if ($model->save()){
            return [['message' => Yii::t('app', 'Your question was sent successfully')]];
        } else {
            return $model;
        }
    }
}
