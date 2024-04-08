<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meetings".
 *
 * @property int $id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 *
 * @property WorkersMeetings[] $workersMeetings
 */
class Meeting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'start_time', 'end_time'], 'required'],
            [['date', 'start_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

    /**
     * Gets query for [[WorkersMeetings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkersMeetings()
    {
        return $this->hasMany(WorkerMeeting::class, ['meeting_id' => 'id']);
    }
}
