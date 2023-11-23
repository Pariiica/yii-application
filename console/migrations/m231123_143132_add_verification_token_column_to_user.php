<?php

use yii\db\Migration;

/**
 * Class m231123_143132_add_verification_token_column_to_user
 */
class m231123_143132_add_verification_token_column_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'verification_token');
    }
}