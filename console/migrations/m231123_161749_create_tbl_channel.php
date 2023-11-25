<?php

use yii\db\Migration;

/**
 * Class m231123_161749_create_tbl_channel
 */
class m231123_161749_create_tbl_channel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        $this->createTable('{{%channel}}', [
            'did' => $this->string(8),
            'username' => $this->string(190)->notNull()->unique(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->text(),
            'image' => $this->string(250),
            'cover' => $this->string(250),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'last_post_at' => $this->integer(),
            'verified' => $this->boolean()->defaultValue(false),
            'tags' => $this->string(1000),
            'addresses' => $this->string(1000),
            'config' => $this->text(),
            'user_sid' => $this->integer(),
            'user_id' => $this->integer(),
            'pinned_video_id' => $this->integer(),
            'paid' => $this->smallInteger(),

        ], $tableOptions);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231123_161749_create_tbl_channel cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231123_161749_create_tbl_channel cannot be reverted.\n";

        return false;
    }
    */
}
