<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property WorkersMeetings[] $workersMeetings
 */
class Worker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }

    /**
     * Gets query for [[WorkersMeetings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeetings()
    {
        return $this->hasMany(Meeting::class, ['id' => 'meeting_id'])
            ->viaTable('workers_meetings', ['worker_id' => 'id']);
    }
}
