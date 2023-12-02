<?php

namespace app\models;

use common\models\VideoQuery;
use Yii;

/**
 * This is the model class for table "channel".
 *
 * @property int $id
 * @property string|null $did
 * @property string|null $username
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $cover
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
 *
 * @property Playlist[] $playlists
 * @property User $user
 * @property Video[] $videos
 */
class Channel extends \yii\db\ActiveRecord
{
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
            [['title'], 'required'],
            [['description', 'config'], 'string'],
            [['type', 'status', 'created_at', 'updated_at', 'last_post_at', 'verified', 'user_id', 'pinned_video_id', 'paid'], 'integer'],
            [['did'], 'string', 'max' => 8],
            [['username'], 'string', 'max' => 190],
            [['title', 'tags', 'addresses'], 'string', 'max' => 500],
            [['image', 'cover'], 'string', 'max' => 250],
            [['username'], 'unique'],
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
            'username' => 'Username',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'cover' => 'Cover',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_post_at' => 'Last Post At',
            'verified' => 'Verified',
            'tags' => 'Tags',
            'addresses' => 'Addresses',
            'config' => 'Config',
            'user_id' => 'User ID',
            'pinned_video_id' => 'Pinned Video ID',
            'paid' => 'Paid',
        ];
    }

    /**
     * Gets query for [[Playlists]].
     *
     * @return \yii\db\ActiveQuery|PlaylistQuery
     */
    public function getPlaylists()
    {
        return $this->hasMany(Playlist::class, ['channel_id' => 'id']);
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
     * Gets query for [[Videos]].
     *
     * @return \yii\db\ActiveQuery|VideoQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::class, ['channel_id' => 'id']);
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
