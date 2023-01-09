<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m230107_211640_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id'          => $this->primaryKey(),
            'title'       => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'priority'    => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'user_id'     => $this->integer()->notNull(),
            'created_at'  => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at'  => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('fk_request_category', 'request', 'category_id', 'category', 'id', "CASCADE", "CASCADE");
        $this->addForeignKey('fk_request_user', 'request', 'user_id', 'user', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
