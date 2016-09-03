<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "session".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $title
 * @property string $starts
 * @property string $ends
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Question[] $questions
 * @property Event $event
 * @property Speaker[] $speakers
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
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
            [['event_id', 'title', 'starts', 'ends', 'description'], 'required'],
            [['event_id', 'created_at', 'updated_at'], 'integer'],
            [['starts', 'ends'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event'),
            'title' => Yii::t('app', 'Title'),
            'starts' => Yii::t('app', 'Starts'),
            'ends' => Yii::t('app', 'Ends'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['session_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeakers()
    {
        return $this->hasMany(Speaker::className(), ['session_id' => 'id']);
    }
}
