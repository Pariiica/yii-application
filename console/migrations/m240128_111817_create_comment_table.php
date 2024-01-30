<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m240128_111817_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(null),
            'text' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'video_id' => $this->integer(),
            'channel_id' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'published_at' => $this->integer(),
        ]);

        $this->createIndex('idx_comment', '{{%comment}}',['id', 'parent_id', 'user_id', 'video_id','channel_id', 'status']);
        $this->addForeignKey('fk_comment_user_id','{{%comment}}','user_id','user', 'id');
        $this->addForeignKey('fk_comment_video_id','{{%comment}}','video_id','video', 'id');
        $this->addForeignKey('fk_comment_channel_id','{{%comment}}','channel_id','channel', 'id');
        $this->addForeignKey('fk_comment_parent_id', '{{%comment}}', 'parent_id', '{{%comment}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_comment','{{%comment}}');
        $this->dropForeignKey('fk_comment_user_id','{{%comment}}');
        $this->dropForeignKey('fk_comment_video_id','{{%comment}}');
        $this->dropForeignKey('fk_comment_channel_id','{{%comment}}');
        $this->dropForeignKey('fk_comment_parent_id','{{%comment}}');
        $this->dropTable('{{%comment}}');
    }
}

