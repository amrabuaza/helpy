<?php

use yii\db\Migration;

/**
 * Class m230131_161255_add_answer_suggestion
 */
class m230131_161255_add_answer_suggestion extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%answer_suggestion}}', [
            'id' => $this->primaryKey(),
            'problem' => $this->string()->notNull(),
            'solution' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->addForeignKey('fk_answer_suggestion_category_id', 'answer_suggestion', 'category_id', 'category', 'id', "CASCADE", "CASCADE");
    }

    public function down()
    {
        $this->dropTable('{{%answer_suggestion}}');
    }
}
