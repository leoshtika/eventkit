<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $session_id
 * @property integer $user_id
 * @property string $question
 *
 * @property Session $session
 * @property User $user
 */
class Question extends \yii\db\ActiveRecord
{
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
    public function rules()
    {
        return [
            [['session_id', 'user_id', 'question'], 'required'],
            [['session_id', 'user_id'], 'integer'],
            [['question'], 'string'],
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
            'session_id' => Yii::t('app', 'Session ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'question' => Yii::t('app', 'Question'),
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
}
