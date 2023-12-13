<?php

use common\models\Channel;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Channel $model */
/** @var yii\bootstrap5\ActiveForm $form */


$users = User::find()->where(['status' => User::STATUS_ACTIVE])->all();
$userArray = [];
foreach ($users as $user) {
    $userArray[$user->id] = $user->username;
}

?>

<div class="channel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'cover')->fileInput() ?>

    <?= $form->field($model, 'type')->dropDownList([

            Channel::TYPE_SYSTEM => 'public', 'private'
    ]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addresses')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList($userArray) ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
