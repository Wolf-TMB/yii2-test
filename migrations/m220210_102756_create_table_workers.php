<?php

use yii\db\Migration;

/**
 * Class m220210_102756_create_table_workers
 */
class m220210_102756_create_table_workers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('workers', array(
			'id' => $this->primaryKey(),
			'firstname' => $this->string(255)->notNull(),
			'lastname' => $this->string(255)->notNull(),
			'phone' => $this->string(15)->notNull(),
			'post' => $this->string(100)->notNull(),
			'status' => $this->boolean()->notNull()->defaultValue(0),
			'wages' => $this->double(15)->notNull()->defaultValue(0)
		));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('workers');
        echo "m220210_102756_create_table_workers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220210_102756_create_table_workers cannot be reverted.\n";

        return false;
    }
    */
}
