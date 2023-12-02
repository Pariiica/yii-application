<?php

namespace app\models;

use common\models\VideoQuery;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $gid
 * @property string|null $did
 * @property string $username
 * @property string|null $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property int|null $type
 * @property int|null $status
 * @property int|null $role
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string $email
 * @property string|null $mobile
 * @property string $first_name
 * @property string $last_name
 * @property string|null $text
 * @property int|null $gender
 * @property int|null $verified
 * @property string|null $birthday
 * @property string|null $image
 * @property string|null $cover
 * @property string|null $config
 * @property int|null $current_channel_id
 * @property string|null $verification_token
 *
 * @property Channel[] $channels
 * @property Playlist[] $playlists
 * @property Video[] $videos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'last_name'], 'required'],
            [['type', 'status', 'role', 'created_at', 'updated_at', 'gender', 'verified', 'current_channel_id'], 'integer'],
            [['birthday'], 'safe'],
            [['gid', 'username', 'auth_key'], 'string', 'max' => 60],
            [['did'], 'string', 'max' => 8],
            [['password_hash', 'password_reset_token', 'first_name', 'last_name', 'image', 'cover'], 'string', 'max' => 250],
            [['email'], 'string', 'max' => 190],
            [['mobile'], 'string', 'max' => 13],
            [['text'], 'string', 'max' => 500],
            [['config'], 'string', 'max' => 1000],
            [['verification_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'did' => 'Did',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'type' => 'Type',
            'status' => 'Status',
            'role' => 'Role',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'text' => 'Text',
            'gender' => 'Gender',
            'verified' => 'Verified',
            'birthday' => 'Birthday',
            'image' => 'Image',
            'cover' => 'Cover',
            'config' => 'Config',
            'current_channel_id' => 'Current Channel ID',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[Channels]].
     *
     * @return \yii\db\ActiveQuery|ChannelQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Playlists]].
     *
     * @return \yii\db\ActiveQuery|PlaylistQuery
     */
    public function getPlaylists()
    {
        return $this->hasMany(Playlist::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Videos]].
     *
     * @return \yii\db\ActiveQuery|VideoQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
