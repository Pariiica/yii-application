<?php

use yii\db\Migration;
use yii\rbac\Role;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'gid' => $this->string(60)->notNull()->defaultValue('user'),
            'username' => $this->string(60)->notNull()->unique(),
            'auth_key' => $this->string(60)->notNull(),
            'password_hash' => $this->string(250)->notNull(),
            'password_reset_token' => $this->string(250)->unique(),
            'type' => $this->smallInteger()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->smallInteger()->notNull()->defaultValue('1'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'email' => $this->string(190)->notNull()->unique(),
            'mobile' => $this->string(13)->notNull(),
            'first_name' => $this->string(250)->notNull(),
            'last_name' => $this->string(250)->notNull(),
            'text' => $this->string(500)->notNull(),
            'gender' => $this->smallInteger()->notNull(),
            'verified' => $this->smallInteger(1)->notNull()->defaultValue(false),
            'birthday' => $this->date()->notNull(),
            'image' => $this->string(250)->notNull(),
            'cover' => $this->string(250)->notNull(),
            'config' => $this->string(1000)->notNull(),
            'current_channel_id' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
