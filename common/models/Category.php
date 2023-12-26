<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use common\dictionaries\Status;


/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property int|null $type
 * @property int|null $status
 * @property int|null $sequence
 * @property string|null $tags
 * @property int|null $parent_id
 *
 * @property Category[] $categories
 * @property Category $parent
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'type'],
                'value' => function () {
                    return $this->type;
                }
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'status'],
                'value' => function () {
                    return $this->isNewRecord ? Status::STATUS_ACTIVE : Status::STATUS_INACTIVE;
                }
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description', 'tags'], 'string'],
            [['type', 'status', 'sequence', 'parent_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 500],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'sequence' => Yii::t('app', 'Sequence'),
            'tags' => Yii::t('app', 'Tags'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
