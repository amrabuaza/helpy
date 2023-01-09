<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_answer}}`.
 */
class m230107_213304_create_request_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_answer}}', [
            'id'         => $this->primaryKey(),
            'content'    => $this->string()->notNull(),
            'request_id' => $this->integer()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_answer}}');
    }
}
