<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video_playlist}}".
 *
 * @property int $id
 * @property int|null $video_id
 * @property int|null $playlist_id
 *
 * @property Playlist $playlist
 * @property Video $video
 */
class VideoPlaylist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video_playlist}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'playlist_id'], 'integer'],
            [['playlist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Playlist::class, 'targetAttribute' => ['playlist_id' => 'id']],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::class, 'targetAttribute' => ['video_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_id' => Yii::t('app', 'Video ID'),
            'playlist_id' => Yii::t('app', 'Playlist ID'),
        ];
    }

    /**
     * Gets query for [[Playlist]].
     *
     * @return \yii\db\ActiveQuery|PlaylistQuery
     */
    public function getPlaylist()
    {
        return $this->hasOne(Playlist::class, ['id' => 'playlist_id']);
    }

    /**
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery|VideoQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::class, ['id' => 'video_id']);
    }

    /**
     * {@inheritdoc}
     * @return VideoPlaylistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoPlaylistQuery(get_called_class());
    }
}
