<?php

/** @var \common\models\Playlist $playlists */


use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<div class="album pt-5 mx-5">
    <div class="container">
        <div class="row">
            <?php foreach ($playlists as $playlist) : ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <?= Html::img(['file/image', 'path' => $playlist->image], ['style'=> 'width: 100%; height: 100%; border-radios: 5px;']) ?>
                        <div class="card-body">
                            <p class="card-text"><?= $playlist->title ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <?= Html::a('view', ['video/view', 'id' => $playlist->id])?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<hr>
