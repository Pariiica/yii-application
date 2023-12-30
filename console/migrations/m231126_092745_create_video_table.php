<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m231126_092745_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'did' => $this->string(8),
            'title' => $this->string(500)->notnull(),
            'description' => $this->text(),
            'slug' => $this->string(250)->defaultValue('genre'),
            'image' => $this->string(1000),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'permission' => $this->smallInteger(),
            'file_status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'published_at' => $this->integer(),
            'via' => $this->smallInteger(),
            'tags' => $this->string(1000),
            'category' => $this->string(500),
            'length' => $this->integer(),
            'location' => $this->string(60),
            'manifest' => $this->string(500),
            'address' => $this->string(250),
            'source' => $this->string(700),
            'config' => $this->integer(),
            'file_service_id' => $this->string(100),
            'channel_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->createIndex('idx_video', '{{%video}}', ['id', 'type', 'status', 'published_at','channel_id','user_id']);
        $this->addForeignKey('fk_video_channel_id','{{%video}}','channel_id','channel', 'id');
        $this->addForeignKey('fk_video_user_id','{{%video}}','user_id','user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_video','{{%video}}');
        $this->dropForeignKey('fk_video_channel_id','{{%video}}');
        $this->dropForeignKey('fk_video_user_id','{{%video}}');
        $this->dropTable('{{%video}}');
    }
}
