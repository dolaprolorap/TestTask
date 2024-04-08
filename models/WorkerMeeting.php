<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers_meetings".
 *
 * @property int $id
 * @property int $worker_id
 * @property int $meeting_id
 *
 * @property Meetings $meeting
 * @property Workers $worker
 */
class WorkerMeeting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers_meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'meeting_id'], 'required'],
            [['worker_id', 'meeting_id'], 'integer'],
            [['meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meeting::class, 'targetAttribute' => ['meeting_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::class, 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'worker_id' => 'Worker ID',
            'meeting_id' => 'Meeting ID',
        ];
    }

    /**
     * Gets query for [[Meeting]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meeting::class, ['id' => 'meeting_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Worker::class, ['id' => 'worker_id']);
    }
}
