<?php

use yii\db\Migration;

/**
 * Class m240405_131428_AddWorkers
 */
class m240405_131428_AddWorkers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('workers', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(20)->notNull(),
            'lastname' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("workers");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240405_131428_AddWorkers cannot be reverted.\n";

        return false;
    }
    */
}
