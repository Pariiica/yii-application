<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m231202_080706_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500),
            'description' => $this->text(),
            'slug' => $this->string(500),
            'type' => $this->smallInteger(),
            'status' => $this->smallInteger(),
            'sequence' => $this->smallInteger(),
            'tags'=> $this->text(),
            'parent_id' => $this->integer()->null(),
        ]);

        $this->createIndex('idx_category','{{%category}}',['id', 'type', 'status', 'parent_id']);
        $this->addForeignKey('fk_category_parent_id','{{%category}}','parent_id','{{%category}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_category','{{%category}}');
        $this->dropForeignKey('fk_category_parent_id','{{%category}}');
        $this->dropTable('{{%category}}');
    }
}
