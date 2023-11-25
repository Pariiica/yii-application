<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%playlist}}`.
 */
class m231125_075541_create_playlist_table extends Migration
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
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'sequence' => $this->smallInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'tags' => $this->string(1000),
            'config' => $this->integer(),
            'channel_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%playlist}}');
    }
}
