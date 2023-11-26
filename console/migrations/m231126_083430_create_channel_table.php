<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%channel}}`.
 */
class m231126_083430_create_channel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%channel}}', [
            'id' => $this->primaryKey(),
            'did' => $this->string(8),
            'username' => $this->string(190)->unique(),
            'title' => $this->string(500)->notNull(),
            'description' => $this->text(),
            'image' => $this->string(250),
            'cover' => $this->string(250),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'last_post_at' => $this->integer(),
            'verified' => $this->boolean(),
            'tags' => $this->string(1000),
            'addresses' => $this->string(1000),
            'config' => $this->text(),
            'user_id' => $this->integer(),
            'pinned_video_id' => $this->integer(),
            'paid' => $this->smallInteger(1),
        ]);

        $this->createIndex('idx_channel_id', '{{%channel}}','id');
        $this->createIndex('idx_channel_username', '{{%channel}}','username');
        $this->createIndex('idx_channel_title', '{{%channel}}','title');
        $this->createIndex('idx_channel_user_id', '{{%channel}}','user_id');
        $this->createIndex('idx_channel_pinned_video_id', '{{%channel}}','pinned_video_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%channel}}');
    }
}
