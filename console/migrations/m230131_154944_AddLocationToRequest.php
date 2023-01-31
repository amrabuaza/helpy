<?php

use yii\db\Migration;

/**
 * Class m230131_154944_AddLocationToRequest
 */
class m230131_154944_AddLocationToRequest extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%request}}', 'latitude', $this->string()->defaultValue(null));
        $this->addColumn('{{%request}}', 'longitude', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%request}}', 'latitude');
        $this->dropColumn('{{%request}}', 'longitude');
    }
}
