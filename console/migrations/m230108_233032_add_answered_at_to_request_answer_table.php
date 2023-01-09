<?php

use yii\db\Migration;

/**
 * Class m230108_233032_add_answered_at_to_request_answer_table
 */
class m230108_233032_add_answered_at_to_request_answer_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%request_answer}}', 'answered_by', $this->integer()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%request_answer}}', 'answered_by');
    }
}
