<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Channel $model */

$this->title = Yii::t('app', 'Create Channel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Channels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('client_form', [
        'model' => $model,
    ]) ?>

</div>
