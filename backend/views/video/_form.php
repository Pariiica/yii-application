<?php

use common\models\Category;
use common\models\Channel;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\widgets\ActiveForm $form */

$users = User::find()->where(['status' => \common\dictionaries\Status::STATUS_ACTIVE])->all();
$userArray = [];
foreach ($users as $user) {
    $userArray[$user->id] = $user->username;
}

$channels = Channel::find()->all();
$channelArray = [];

foreach ($channels as $channel) {
    $channelArray[$channel->id] = $channel->title;
}


$cat = Category::find()->all();
$catArray = ArrayHelper::map($cat,'id', 'name')
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'type')->dropDownList([
        \common\dictionaries\Status::STATUS_ACTIVE => 'public', 'private'
    ]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList($catArray) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'channel_id')->dropDownList($channelArray) ?>

    <?= $form->field($model, 'user_id')->dropDownList($userArray) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
