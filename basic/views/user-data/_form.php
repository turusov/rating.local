<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\Faculty;
/* @var $this yii\web\View */
/* @var $model app\models\UserData */
/* @var $form yii\widgets\ActiveForm */
$d = Department::find()->all(); //кафедры
$f = Faculty::find()->all();
$departments = array();
$faculties = array();
foreach($f as $i){
   $faculties[$i->id] = $i->title;
   $tmp = [];
   foreach($d as $j){
       if($j->faculty_id == $i->id){
        array_push($tmp,$j->title);  
       }
    }
    $departments[$i->title]=$tmp; 
}


// foreach($f as $i){
//     $faculties[$i->id] = $i->title;
// }
?>

<div class="user-data-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label('Фамилия')?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Имя') ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true])->label('Отчество') ?>

    <?= $form->field($model, 'faculty_id')->dropDownList($faculties, ['prompt'=>'выберите статус...'])->label('Факультет') ?>
    
    <?= $form->field($model, 'department_id')->dropDownList($departments, ['prompt'=>'выберите статус...'])->label('Кафедра') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
