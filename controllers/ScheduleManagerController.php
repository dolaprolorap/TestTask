<?php

namespace app\controllers;

use app\models\Worker;
use app\components\ScheduleMaker;
use yii\base\DynamicModel;

class ScheduleManagerController extends \yii\web\Controller
{
    public function actionMake() {
        $request = \Yii::$app->request;
        $workerId = $request->get("workerId");
        $date = $request->get("date");

        // changing format of response
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        // regex for date
        // Ex:
        // 2023-03-29
        $dateRegex = '/^([0-9]{4})-(1[0-2]|0[1-9])-(3[01]|[12][0-9]|0[1-9])$/';

        // validate input data
        $model = new DynamicModel(['workerId' => $workerId, 'date' => $date]);
        $model->addRule('workerId', 'integer')
            ->addRule('date', 'match', ['pattern' => $dateRegex])
            ->validate();
        
        if ($model->hasErrors()) {
            throw new \yii\web\NotFoundHttpException;
        }

        // get worker by id
        $worker = Worker::find()->where(['id' => $workerId])->one();
        if($worker == null) {
            throw new \yii\web\NotFoundHttpException;
        }
        // get meetings at exact date
        $meetingsAtDate = array_filter($worker->meetings, fn($meeting) => $meeting["date"] == $date);

        // create instance of ScheduleMaker and make schedule
        $sm = new ScheduleMaker();
        $response->data = $sm->make($meetingsAtDate);
    }
}
