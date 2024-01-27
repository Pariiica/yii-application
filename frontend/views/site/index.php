<?php

/** @var yii\web\View $this */
/** @var \common\models\Video[] $models */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<div class="album pt-5 mx-5">
    <div class="container">
        <div class="row">
            <?php foreach ($models as $model) : ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm">
                        <?= Html::img(['file/image', 'path' => $model->image], ['style'=> 'width: 100%; height: 100%; border-radios: 5px;']) ?>
                        <div class="card-body">
                            <p class="card-text"><?= $model->title ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        <?= Html::a('view', ['video/view', 'id' => $model->id])?>
                                    </button>
                                </div>
                                <small class="text-muted"><?= $model->length ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php echo LinkPager::widget(['pagination'=>$pagination]) ?>
<hr>


