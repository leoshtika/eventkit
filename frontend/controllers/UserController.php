<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['account'],
                'rules' => [
                    [
                        'actions' => ['account'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    /**
     * Shows and updates the user account
     * @return mixed
     */
    public function actionAccount()
    {
        $model = User::findIdentity(Yii::$app->user->id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->newPassword) {
                $model->setPassword($model->newPassword);
                $model->generateAuthKey();
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Your account has been successfully updated.');
            }
        }

        return $this->render('account', [
            'model' => $model,
        ]);
    }

}