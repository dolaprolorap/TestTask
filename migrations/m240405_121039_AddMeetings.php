<?php

use yii\db\Migration;

/**
 * Class m240405_121039_AddMeetings
 */
class m240405_121039_AddMeetings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('meetings', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'start_time' => $this->time()->notNull(),
            'end_time' => $this->time()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("meetings");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240405_121039_AddMeetings cannot be reverted.\n";

        return false;
    }
    */
}
