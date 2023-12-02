<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
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
 * @property int|null $length
 * @property string|null $location
 * @property string|null $manifest
 * @property string|null $address
 * @property string|null $source
 * @property int|null $config
 * @property string|null $file_service_id
 * @property int|null $channel_id
 * @property int|null $user_id
 *
 * @property Channel $channel
 * @property User $user
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['type', 'status', 'permission', 'file_status', 'created_at', 'updated_at', 'published_at', 'via', 'length', 'config', 'channel_id', 'user_id'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['title', 'manifest'], 'string', 'max' => 500],
            [['slug', 'address'], 'string', 'max' => 250],
            [['image', 'tags'], 'string', 'max' => 1000],
            [['location'], 'string', 'max' => 60],
            [['source'], 'string', 'max' => 700],
            [['file_service_id'], 'string', 'max' => 100],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::class, 'targetAttribute' => ['channel_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Did',
            'title' => 'Title',
            'description' => 'Description',
            'slug' => 'Slug',
            'image' => 'Image',
            'type' => 'Type',
            'status' => 'Status',
            'permission' => 'Permission',
            'file_status' => 'File Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
            'via' => 'Via',
            'tags' => 'Tags',
            'length' => 'Length',
            'location' => 'Location',
            'manifest' => 'Manifest',
            'address' => 'Address',
            'source' => 'Source',
            'config' => 'Config',
            'file_service_id' => 'File Service ID',
            'channel_id' => 'Channel ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Channel]].
     *
     * @return \yii\db\ActiveQuery|ChannelQuery
     */
    public function getChannel()
    {
        return $this->hasOne(Channel::class, ['id' => 'channel_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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
