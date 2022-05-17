<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserStatus;
use app\models\Block;
use app\models\Criteria;
/* @var $this yii\web\View */
/* @var $model app\models\Criteria */
/* @var $form yii\widgets\ActiveForm */
$statuses = UserStatus::find()->all(); //кафедры
foreach($statuses as $status)
{
    $roles[$status->id] = $status->title;
}

$blocks = Block::find()->all();
foreach($blocks as $block)
{
    $arr[$block->id] = '№'.$block->id.'. '.$block->title;
}
$blocks = $arr;
?>


<div class="criteria-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'block_id')->dropDownList($blocks, ['prompt'=>'выберите блок...'])->label('Блок критериев') ?>
    
    <p>
        <?= Html::a('Редактировать блоки критериев', ['block/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $form->field($model, 'criteria_title')->label('Название критерия')->textInput(['maxlength' => true])?>


    <?= $form->field($model, 'info_point')->label('Информация о баллах')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'access')->dropDownList($roles, ['prompt'=>'выберите роль...'])->label('Кто заполняет') ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([null=>'Да', 1=>'Нет'])->label('Критерий активен в текущем году') ?>

    <?= $form->field($model, 'min_value')->label('Минимальное значение балла критерия(которое больше нуля)')->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'max_value')->label('Максимальное значение балла критерия(может совпадать с минимальным)')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
