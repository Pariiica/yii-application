<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playlist".
 *
 * @property int $id
 * @property string|null $did
 * @property string|null $title
 * @property string|null $description
 * @property string|null $slug
 * @property string|null $image
 * @property int|null $type
 * @property int|null $status
 * @property int|null $sequence
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $tags
 * @property int|null $config
 * @property int|null $channel_id
 * @property int|null $user_id
 *
 * @property Channel $channel
 * @property User $user
 */
class Playlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playlist';
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
            [['slug', 'image'], 'string', 'max' => 250],
            [['tags'], 'string', 'max' => 1000],
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
            'sequence' => 'Sequence',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'tags' => 'Tags',
            'config' => 'Config',
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
     * @return PlaylistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaylistQuery(get_called_class());
    }
}
