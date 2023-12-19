<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gid',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'type',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \common\widgets\Status::widget(['status' => $model->status]);
                }
            ],
            //'role',
            //'created_at',
            //'updated_at',
            //'email:email',
            //'mobile',
            //'first_name',
            //'last_name',
            //'text',
            //'gender',
            //'verified',
            //'birthday',
            //'image',
            //'cover',
            //'config',
            //'current_channel_id',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
