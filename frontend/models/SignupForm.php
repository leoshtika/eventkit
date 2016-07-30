<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $full_name;
    public $email;
    public $password;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['full_name', 'trim'],
            ['full_name', 'required'],
            ['full_name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app', 'This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['verifyCode', 'captcha'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'full_name' => Yii::t('app', 'Full name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'verifyCode' => Yii::t('app', 'Verification code'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->full_name = $this->full_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
