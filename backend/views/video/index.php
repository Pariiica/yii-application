<?php

use common\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\VideoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Videos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Video'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'description:text',
            'slug',
            //'image',
            //'type',
            [
                'attribute' => 'status',
                'value' => function ($model){
                    return \common\widgets\Status::widget(['status' => $model->status]);
                }
            ],
            //'permission',
            //'file_status',
            //'created_at',
            //'updated_at',
            //'published_at',
            //'via',
            //'tags',
            //'length',
            //'location',
            //'manifest',
            //'address',
            //'source',
            //'config',
            //'file_service_id',
            //'channel_id',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Video $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
