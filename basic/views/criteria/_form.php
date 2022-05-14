<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Criteria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="criteria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'criteria_id')->textInput() ?>

    <?= $form->field($model, 'criteria_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info_point')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <?= $form->field($model, 'block_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
