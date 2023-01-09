<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m230107_223351_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'status' => 'ENUM("active","inactive") DEFAULT "active"',
            'slug' => $this->string()->null(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->createTable('{{article_language}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('fk_article_language', 'article_language', 'article_id', 'article', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
