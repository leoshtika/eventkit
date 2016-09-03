<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $starts
 * @property string $ends
 * @property string $location
 * @property string $latitude
 * @property string $longitude
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Session[] $sessions
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
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
            [['title', 'starts', 'ends', 'location', 'description'], 'required'],
            [['starts', 'ends'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'integer'], 
            [['title', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'starts' => Yii::t('app', 'Starts'),
            'ends' => Yii::t('app', 'Ends'),
            'location' => Yii::t('app', 'Location'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['event_id' => 'id']);
    }
}
