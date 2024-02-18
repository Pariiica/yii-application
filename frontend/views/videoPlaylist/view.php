<?php

/** @var \common\models\VideoPlaylist $videoPlaylist */
/** @var \common\models\Video $videos */

use yii\helpers\Html;

?>
<h1><?= $videoPlaylistt->title ?></h1>
<div class="album pt-5 mx-5">
    <div class="container">
        <div class="row">
            <?php foreach ($videos as $video) : ?>
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
            <form action="<?= Yii::$app->urlManager->createUrl(['playlist/add-video', 'playlistId' => $playlist->id]) ?>" method="post">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Videos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <?php foreach ($videos as $video): ?>
                            <li><a class="dropdown-item" href="#"><?= $video->title ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <button class="btn btn-primary" type="submit">Add Video</button>
            </form>
        </div>
    </div>
</div>
