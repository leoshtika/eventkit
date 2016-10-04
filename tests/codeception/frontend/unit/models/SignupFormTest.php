<?php

namespace tests\codeception\frontend\unit\models;

use tests\codeception\frontend\unit\DbTestCase;
use tests\codeception\common\fixtures\UserFixture;
use Codeception\Specify;
use frontend\models\SignupForm;

class SignupFormTest extends DbTestCase
{

    use Specify;

    public function testMissingCaptchaSignup()
    {
        $model = new SignupForm([
            'full_name' => 'Some Name',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);
        
        expect('captcha is not added, user should not be created', $model->signup())->null();
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'full_name' => 'Nicolas Dianna',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        expect('username and email are in use, user should not be created', $model->signup())->null();
    }

    public function fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/frontend/unit/fixtures/data/models/user.php',
            ],
        ];
    }
}
