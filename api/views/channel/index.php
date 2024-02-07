<?php

use common\models\Channel;
use common\widgets\Status;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ChannelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Channels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Channel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'did',
            'username',
            'title',
            'description:text',
            //'image',
            //'cover',
            //'type',
            [
                'attribute' => 'status',
                'value' => function ($model){
                    return Status::widget(['model' => $model])  . $model->statusName;
                },
                'format' => 'html'
            ],
            //'created_at',
            //'updated_at',
            //'last_post_at',
            //'verified',
            //'tags',
            //'addresses',
            //'config:ntext',
            //'user_id',
            //'pinned_video_id',
            //'paid',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Channel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
