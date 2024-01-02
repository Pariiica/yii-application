<?php

use common\Widgets\Status;
use common\models\Playlist;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PlaylistSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Playlists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="playlist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Playlist'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'did',
            'title',
            'description:ntext',
            'slug',
            //'image',
            //'type',
            [
                'attribute' => 'status',
                'value' => function ($model){
                    return Status::widget(['model' => $model])  . $model->statusName;
                },
                'format' => 'html'
            ],
            //'sequence',
            //'created_at',
            //'updated_at',
            //'tags',
            //'config',
            //'channel_id',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Playlist $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
