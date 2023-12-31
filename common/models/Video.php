<?php

namespace common\models;

use common\dictionaries\Status;
use Hashids\Hashids;
use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property int $id
 * @property string|null $did
 * @property string|null $title
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $image
 * @property int|null $type
 * @property int|null $status
 * @property int|null $permission
 * @property int|null $file_status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $published_at
 * @property int|null $via
 * @property string|null $tags
 * @property String|null $category
 * @property int|null $length
 * @property string|null $location
 * @property string|null $manifest
 * @property string|null $address
 * @property string|null $source
 * @property int|null $config
 * @property string|null $file_service_id
 * @property int|null $channel_id
 * @property int|null $user_id
 */
class Video extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
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
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'status'],
                'value' => function () {
                    return $this->isNewRecord ? Status::STATUS_ACTIVE : Status::STATUS_INACTIVE;
                }
            ],
            [
                'class' => UploadImageBehavior::class,
                'attributes' => ['image'],
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [self::EVENT_BEFORE_INSERT => 'user_id'],
                'value' => function () {
                    if (!Yii::$app->user->isGuest) {
                        return Yii::$app->user->id;
                    }

                    return null;
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
            [['title'],'required'],
            [['description'], 'string'],
            [['type', 'status', 'permission', 'file_status', 'created_at', 'updated_at', 'published_at', 'via', 'length', 'config', 'channel_id', 'user_id'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['title', 'manifest', 'category'], 'string', 'max' => 500],
            [['slug', 'address'], 'string', 'max' => 250],
            [['tags', 'file_service_id'], 'string', 'max' => 1000],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['location'], 'string', 'max' => 60],
            [['source'], 'string', 'max' => 700],
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
            'permission' => Yii::t('app', 'Permission'),
            'file_status' => Yii::t('app', 'File Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'published_at' => Yii::t('app', 'Published At'),
            'via' => Yii::t('app', 'Via'),
            'tags' => Yii::t('app', 'Tags'),
            'category' => Yii::t('app', 'category'),
            'length' => Yii::t('app', 'Length'),
            'location' => Yii::t('app', 'Location'),
            'manifest' => Yii::t('app', 'Manifest'),
            'address' => Yii::t('app', 'Address'),
            'source' => Yii::t('app', 'Source'),
            'config' => Yii::t('app', 'Config'),
            'file_service_id' => Yii::t('app', 'File Service ID'),
            'channel_id' => Yii::t('app', 'Channel ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
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
        $this->save(false);
        // false is for preventing updating after saving the video model
    }

    public function getStatusName()
    {
        $data = Status::$statusLabels;
        return isset($data[$this->status]) ? $data[$this->status] : 'unknown';
    }
}
