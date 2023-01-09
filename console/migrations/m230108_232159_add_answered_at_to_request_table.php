<?php

use yii\db\Migration;

/**
 * Class m230108_232159_add_answered_at_to_request_table
 */
class m230108_232159_add_answered_at_to_request_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%request}}', 'answered_at', $this->dateTime()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%request}}', 'answered_at');
    }
}
