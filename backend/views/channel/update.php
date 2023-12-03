<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Channel $model */

$this->title = Yii::t('app', 'Update Channel: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Channels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="channel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('client_form', [
        'model' => $model,
    ]) ?>

</div>