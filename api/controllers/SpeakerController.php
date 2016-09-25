<?php

namespace api\controllers;

use yii\rest\Controller;
use common\models\Speaker;

class SpeakerController extends Controller
{
    
    /**
     * Returns all the speakers
     * @TODO: Change this method and the endpoint url to get the speakers from one event (using POST)
     * @return array
     */
    public function actionIndex() {

        return  Speaker::find()
                ->select(['full_name', 'email', 'resume', 'id AS image_id', 'created_at', 'updated_at'])
                ->asArray()
                ->all();
    }
}
