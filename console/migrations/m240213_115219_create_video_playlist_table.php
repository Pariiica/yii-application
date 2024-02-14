<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video_playlist}}`.
 */
class m240213_115219_create_video_playlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video_playlist}}', [
            'id' => $this->primaryKey(),
            'video_id' => $this->integer(),
            'playlist_id' => $this->integer(),
        ]);

        $this->createIndex('idx_video_playlist', '{{%video_playlist}}',['id', 'video_id','playlist_id']);
        $this->addForeignKey('fk_video_playlist_video_id','{{%video_playlist}}','video_id','video', 'id');
        $this->addForeignKey('fk_video_playlist_playlist_id','{{%video_playlist}}','playlist_id','playlist', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_video_playlist','{{%video_playlist}}');
        $this->dropForeignKey('fk_video_playlist_video_id','{{%video_playlist}}');
        $this->dropForeignKey('fk_video_playlist_playlist_id','{{%video_playlist}}');
        $this->dropTable('{{%video_playlist}}');
    }
}
