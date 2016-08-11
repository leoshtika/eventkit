<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "speaker".
 *
 * @property integer $id
 * @property integer $session_id
 * @property string $full_name
 * @property string $email
 * @property string $resume
 *
 * @property Session $session
 */
class Speaker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speaker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'full_name', 'email', 'resume'], 'required'],
            [['session_id'], 'integer'],
            [['resume'], 'string'],
            [['full_name', 'email'], 'string', 'max' => 255],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['session_id' => 'id']],
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
            'full_name' => Yii::t('app', 'Full Name'),
            'email' => Yii::t('app', 'Email'),
            'resume' => Yii::t('app', 'Resume'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'session_id']);
    }
}
