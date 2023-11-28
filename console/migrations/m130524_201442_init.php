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
            'did' => $this->string(8),
            'username' => $this->string(60)->notNull()->unique(),
            'auth_key' => $this->string(60),
            'password_hash' => $this->string(250),
            'password_reset_token' => $this->string(250)->unique(),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger()->defaultValue(10),
            'role' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'email' => $this->string(190)->notNull()->unique(),
            'mobile' => $this->string(13),
            'first_name' => $this->string(250)->notNull(),
            'last_name' => $this->string(250)->notNull(),
            'text' => $this->string(500),
            'gender' => $this->smallInteger(),
            'verified' => $this->smallInteger(1),
            'birthday' => $this->date(),
            'image' => $this->string(250),
            'cover' => $this->string(250),
            'config' => $this->string(1000),
            'current_channel_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx_user', '{{%user}}',['id', 'username','updated_at','type','status','current_channel_id']);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropIndex('idx_user','{{%user}}');
    }
}
