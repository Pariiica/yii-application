<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%playlist}}`.
 */
class m231126_113304_create_playlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%playlist}}', [
            'id' => $this->primaryKey(),
            'did' => $this->string(8),
            'title' => $this->string(500),
            'description' => $this->text(),
            'slug' => $this->string(250),
            'image' => $this->string(250),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'sequence' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'tags' => $this->string(1000),
            'config' => $this->integer(),
            'channel_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->createIndex('idx_playlist_id', '{{%playlist}}', 'id');
        $this->createIndex('idx_playlist_title', '{{%playlist}}', 'title');
        $this->createIndex('idx_playlist_created_at', '{{%playlist}}', 'created_at');
        $this->createIndex('idx_playlist_channel_id', '{{%playlist}}', 'channel_id');
        $this->createIndex('idx_playlist_user_id', '{{%playlist}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%playlist}}');
    }
}
