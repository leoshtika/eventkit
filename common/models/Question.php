<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $session_id
 * @property integer $user_id
 * @property string $question
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Session $session
 * @property User $user
 */
class Question extends \yii\db\ActiveRecord
{
    const STATUS_NEW    = 10; // question is new (not answered yet)
    const STATUS_CLOSED = 20; // question is closed (answered)
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
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
            [['session_id', 'user_id', 'question'], 'required'],
            [['session_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['question'], 'string'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'session_id' => Yii::t('app', 'Session'),
            'user_id' => Yii::t('app', 'User'),
            'question' => Yii::t('app', 'Question'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'session_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * Returns an array with all question statuses
     * @return array
     */
    public function getStatusList() {
        return [
            self::STATUS_NEW => Yii::t('app', 'New'),
            self::STATUS_CLOSED => Yii::t('app', 'Closed'),
        ];
    }
    
    /**
     * Returns the label of this question's status
     * @return string
     */
    public function getStatusLabel()
    {
        $statusAll = $this->getStatusList();
        return $statusAll[$this->status];
    }
}
