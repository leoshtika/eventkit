<?php

namespace api\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\web\Response;
use common\models\LoginForm;
use common\models\User;

class UserController extends Controller
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
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['options', 'login', 'create'],
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
                    'actions' => ['login'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['create'],
                    'allow' => true,
                    'roles' => ['?'],
                ],
                [
                    'actions' => ['account'],
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
     * User login with username & password
     * @return LoginForm
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return [
                'access_token' => Yii::$app->user->identity->getAuthKey(),
                'full_name' => Yii::$app->user->identity->full_name
            ];
        } else {
            $model->validate();
            return $model;
        }
    }

    /**
     * Creates a new User model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            $model->setPassword($model->password);
            $model->generateAuthKey();
            
            if ($model->save()){
                return [['message' => Yii::t('app', 'Your registration was completed successfully')]];
            } else {
                return $model;
            }
        } else {
            Yii::$app->response->statusCode = 400;
            return [['message' => Yii::t('app', 'The server cannot process your request.')]];
        }
    }
    
    /**
     * Returns user details if he is authenticated
     * @return array user account
     */
    public function actionAccount()
    {
        $response = [
            'email' => Yii::$app->user->identity->email,
            'full_name' => Yii::$app->user->identity->full_name,
            'avatar_url' => $this->getAvatarUrl(),
            'created_at' => Yii::$app->user->identity->created_at,
            'updated_at' => Yii::$app->user->identity->updated_at,
        ];

        return $response;
    }
    
    /**
     * Returns the users avatar image
     * @return string
     */
    public function getAvatarUrl()
    {
        $gravatarUrl = 'https://secure.gravatar.com/avatar/';
        $gravatarHash = md5(strtolower(trim(Yii::$app->user->identity->email)));
        $defaultImage = 'mm';

        return $gravatarUrl . $gravatarHash .'?d='.$defaultImage;
    }
    
}
