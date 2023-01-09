<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m230107_211545_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status' => 'ENUM("active","inactive") DEFAULT "active"',
            'slug' => $this->string()->null(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->createTable('{{%category_language}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('fk_category_language', 'category_language', 'category_id', 'category', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
