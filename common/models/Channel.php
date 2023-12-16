<?php

namespace common\models;

use Hashids\Hashids;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%channel}}".
 *
 * @property int $id
 * @property string|null $did
 * @property string|null $username
 * @property string $title
 * @property string|null $description
 * @property null $image
 * @property null $cover
 * @property int|null $type
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $last_post_at
 * @property int|null $verified
 * @property string|null $tags
 * @property string|null $addresses
 * @property string|null $config
 * @property int|null $user_id
 * @property int|null $pinned_video_id
 * @property int|null $paid
 */
class Channel extends \yii\db\ActiveRecord
{
    const TYPE_SYSTEM = 1;
    const STATUS_DEFAULT = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%channel}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'type'],
                'value' => function () {
                    return $this->type ?: self::TYPE_SYSTEM;
                }
            ],
            [
                'class' => UploadImageBehavior::class,
                'attributes' => ['image', 'cover']
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'status'],
                'value' => function () {
                    return $this->status ?: self::STATUS_DEFAULT;
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
            [['title'], 'required'],
            [['description', 'config'], 'string'],
            [['type', 'status', 'created_at', 'updated_at', 'last_post_at', 'verified', 'user_id', 'pinned_video_id', 'paid'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['username'], 'string', 'max' => 190],
            [['title'], 'string', 'max' => 500],
            [['image', 'cover'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['tags', 'addresses'], 'string', 'max' => 1000],
            [['username'], 'unique'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'pinned_video_id' => Yii::t('app', 'Pinned Video ID'),
            'paid' => Yii::t('app', 'Paid'),
        ];
    }

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_AFTER_INSERT, [$this,'addDisplayId']);
    }

    //yii::debug(message, category)
    public function addDisplayId()
    {
        $hashids = new Hashids('channel', 8);
        $did = $hashids->encode($this->id);

        $this->did = $did;
        $this->save();
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
