<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m231124_100321_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'did' => $this->string(8),
            'title' => $this->string(500),
            'description' => $this->text(),
            'slug' => $this->string(250),
            'image' => $this->string(1000),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'permission' => $this->smallInteger(),
            'file_status' => $this->smallInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'published_at' => $this->integer()->notNull(),
            'via' => $this->smallInteger(),
            'tags' => $this->string(1000),
            'length' => $this->integer(),
            'location' => $this->string(60),
            'manifest' => $this->string(500),
            'address' => $this->string(250),
            'source' => $this->string(700),
            'config' => $this->integer(),
            'file_service_id' => $this->string(1000),
            'channel_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
