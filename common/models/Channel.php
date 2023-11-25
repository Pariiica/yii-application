<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "channel".
 *
 * @property string|null $did
 * @property string $username
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $cover
 * @property int|null $type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_post_at
 * @property int $verified
 * @property string $tags
 * @property string $addresses
 * @property string $config
 * @property int $user_sid
 * @property int $user_id
 * @property int $pinned_video_id
 * @property int|null $paid
 */
class Channel extends \yii\db\ActiveRecord
{
    const TYPE_SYS = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'title'], 'required'],
            [['description', 'config'], 'string'],
            [['type', 'status', 'created_at', 'updated_at', 'last_post_at','last_post_at','pinned_video_id','addresses', 'config', 'user_sid', 'verified', 'user_sid', 'user_id', 'pinned_video_id', 'paid'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['username'], 'string', 'max' => 190],
            [['title'], 'string', 'max' => 500],
            [['image', 'cover'], 'string', 'max' => 250],
            [['tags', 'addresses'], 'string', 'max' => 1000],
            [['username'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'type'],
                'value' => function () {
                    return $this->type ?: self::TYPE_SYS;
                }
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'status'],
                'value' => function () {
                    return $this->status ?: self::TYPE_SYS;
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'did' => Yii::t('app', 'Did'),
            'username' => Yii::t('app', 'Username'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'cover' => Yii::t('app', 'Cover'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'last_post_at' => Yii::t('app', 'Last Post At'),
            'verified' => Yii::t('app', 'Verified'),
            'tags' => Yii::t('app', 'Tags'),
            'addresses' => Yii::t('app', 'Addresses'),
            'config' => Yii::t('app', 'Config'),
            'user_sid' => Yii::t('app', 'User Sid'),
            'user_id' => Yii::t('app', 'User ID'),
            'pinned_video_id' => Yii::t('app', 'Pinned Video ID'),
            'paid' => Yii::t('app', 'Paid'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ChannelQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new ChannelQuery(get_called_class());
    }
}