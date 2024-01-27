<?php

/** @var yii\web\View $this */
/** @var Video[] $models */
/** @var Video $model */

use common\models\Video;
use yii\helpers\Html;

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
            <?= Html::img(['file/image', 'path' => $model->image], ['style'=> 'width: 90%; height: 60%;']) ?>
            <h2 style="margin: 1rem 0"><?= $model->title ?></h2>
            <p style="margin: 1rem 0"><?= $model->description ?></p>
        </div>
        <div class="related-videos">
            <h3>Related Videos</h3>
            <?php foreach ($models as $model) : ?>
                <div class="card" style="margin-bottom: 1rem">
                    <?= Html::img(['file/image', 'path' => $model->image], ['style'=> 'width: 100%; height: 90%;']) ?>
                    <div class="card-body">
                        <h5><?= $model->title ?></h5>
                        <p><?= $model->description ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>

