<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin_category}}`.
 */
class m230108_222336_create_admin_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin_category}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('fk_admin_category_admin_id', 'admin_category', 'user_id', 'user', 'id', "CASCADE", "CASCADE");
        $this->addForeignKey('fk_admin_category_category_id', 'admin_category', 'category_id', 'category', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin_category}}');
    }
}
