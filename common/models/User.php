<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE     = 10; // user is active
    const STATUS_INACTIVE   = 20; // user is inactive
    
    const ROLE_USER         = 10; // frontend user
    const ROLE_ADMIN        = 20; // administrator

    // Used when creating a new User
    public $password;
    
    // Used when updating a User
    public $newPassword;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'email'], 'required'],
            [['role', 'status'], 'integer'],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'validateRole'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'validateStatus'],
            [['full_name', 'email'], 'string', 'max' => 255],
            ['email', 'unique'],
            ['email', 'email'],
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
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
            
            // Custom attributes
            'password' => Yii::t('app', 'Password'),
            'newPassword' => Yii::t('app', 'New password'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * An inline validator for 'status'
     * @param string $attribute
     */
    public function validateStatus($attribute)
    {
        if (!array_key_exists($this->$attribute, $this->getStatusList())) {
            $this->addError($attribute, Yii::t('app', 'The status value is not valid'));
        }
    }
    
    /**
     * An inline validator for 'role'
     * @param string $attribute
     */
    public function validateRole($attribute)
    {
        if (!array_key_exists($this->$attribute, $this->getRoleList())) {
            $this->addError($attribute, Yii::t('app', 'The role value is not valid'));
        }
    }

    /**
     * Returns an array with all user statuses
     * @return array
     */
    public function getStatusList() {
        return [
            self::STATUS_ACTIVE => Yii::t('user', 'Active'),
            self::STATUS_INACTIVE => Yii::t('user', 'Inactive'),
        ];
    }
    
    /**
     * Returns the label of this user's status
     * @return string
     */
    public function getStatusLabel()
    {
        $statusAll = $this->getStatusList();
        return $statusAll[$this->status];
    }
    
    /**
     * Returns an array with all user roles
     * @return array
     */
    public function getRoleList() {
        return [
            self::ROLE_USER => Yii::t('app', 'User'),
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
        ];
    }
    
    /**
     * Returns the label of this user's status
     * @return string
     */
    public function getRoleLabel() {
        $roleAll = $this->getRoleList();
        return $roleAll[$this->role];
    }
}
