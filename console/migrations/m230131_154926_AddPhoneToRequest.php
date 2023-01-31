<?php

use yii\db\Migration;

/**
 * Class m230131_154926_AddPhoneToRequest
 */
class m230131_154926_AddPhoneToRequest extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%request}}', 'phone_number', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%request}}', 'phone_number');
    }
}
