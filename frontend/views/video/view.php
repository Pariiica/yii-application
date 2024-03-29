<?php

/** @var yii\web\View $this */
/** @var Video[] $videos */
/** @var Video $video */
/** @var Comment $comment */
/** @var Comment $comments */

use common\models\Comment;
use common\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<style>
        .video-container {
            width: 70%;
            float: left;
            margin: 1rem
        }
        .related-videos {
            width: 20%;
            float: left;
            margin: 1rem
        }
        @media (max-width: 768px) {
            .video-container, .related-videos {
                width: 100%;
            }
        }
</style>
<body>
<div class="container">
    <div class="row">
        <div class="video-container">
            <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 90%; height: 45%;']) ?>
            <div class="d-flex align-items-center">
                <a href="<?= Url::to(['channel/view', 'id' => $video->channel_id]) ?>">
                    <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 5rem; height: 5rem; border-radius: 50%']) ?>
                </a>
                <div class="m-3">
                    <h2 style="margin: 1rem 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $video->title ?></h2>
                    <p style="margin: 1rem 0;"><?= $video->description ?></p>
                </div>
            </div>
            <?= \app\widgets\Comment::widget([
                'video' => $video,
                'comments' => $comments,
            ]) ?>
        </div>
        <div class="related-videos">
            <h3>Related Videos</h3>
            <?php foreach ($videos as $video) : ?>
                <div class="card" style="margin-bottom: 1rem">
                    <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 100%; height: 90%;']) ?>
                    <div class="card-body">
                        <h5><?= $video->title ?></h5>
                        <p><?= $video->description ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>

