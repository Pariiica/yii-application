<?php

/** @var \common\models\VideoPlaylist $videoPlaylist */
/** @var \common\models\Video $videos */

use yii\helpers\Html;

?>
<h1><?= $videoPlaylist->title ?></h1>
<div class="album pt-5 mx-5">
    <div class="container">
        <div class="row">
            <?php
            foreach ($videos as $video) : ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <?= Html::img(['file/image', 'path' => $video->image], ['style'=> 'width: 100%; height: 60%;']) ?>
                        <div class="card-body">
                            <h4><?= $video->title ?></h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Watch</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
