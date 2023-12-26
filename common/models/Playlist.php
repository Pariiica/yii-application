<?php

namespace common\models;

use common\dictionaries\Status;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%playlist}}".
 *
 * @property int $id
 * @property string|null $did
 * @property string|null $title
 * @property string|null $description
 * @property string|null $slug
 * @property null $image
 * @property int|null $type
 * @property int|null $status
 * @property int|null $sequence
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $tags
 * @property int|null $config
 * @property int|null $channel_id
 * @property int|null $user_id
 */
class Playlist extends \yii\db\ActiveRecord
{
    const TYPE_SYSTEM = 3;
    const STATUS_DEFAULT = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%playlist}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'type'],
                'value' => function () {
                    return $this->type;
                }
            ],
            [
                'class' => UploadImageBehavior::class,
                'attributes' => ['image']
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'status'],
                'value' => function () {
                    return $this->isNewRecord ? Status::STATUS_ACTIVE : Status::STATUS_INACTIVE;
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['type', 'status', 'sequence', 'created_at', 'updated_at', 'config', 'channel_id', 'user_id'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['title'], 'string', 'max' => 500],
            [['slug'], 'string', 'max' => 250],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['tags'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'did' => Yii::t('app', 'Did'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'sequence' => Yii::t('app', 'Sequence'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'tags' => Yii::t('app', 'Tags'),
            'config' => Yii::t('app', 'Config'),
            'channel_id' => Yii::t('app', 'Channel ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlaylistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaylistQuery(get_called_class());
    }
}
