<?php

use yii\db\Migration;

/**
 * Class m240405_142544_AddWorkersMeetings
 */
class m240405_142544_AddWorkersMeetings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('workers_meetings', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer()->notNull(),
            'meeting_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-workers_meetings-workers',
            'workers_meetings',
            'worker_id'
        );
        $this->addForeignKey(
            'fk-workers_meetings-workers',
            'workers_meetings',
            'worker_id',
            'workers',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-workers_meetings-meetings',
            'workers_meetings',
            'meeting_id'
        );
        $this->addForeignKey(
            'fk-workers_meetings-meetings',
            'workers_meetings',
            'meeting_id',
            'meetings',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('workers_meetings');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240405_142544_AddWorkersMeetings cannot be reverted.\n";

        return false;
    }
    */
}
