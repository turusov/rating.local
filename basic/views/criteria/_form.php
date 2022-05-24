<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserStatus;
use app\models\Block;
use app\models\Criteria;
use app\models\CriteriaAccess;
use yii\helpers\ArrayHelper; 
/* @var $this yii\web\View */
/* @var $model app\models\Criteria */
/* @var $form yii\widgets\ActiveForm */
$blocks = Block::find()->all();
foreach($blocks as $block)
{
    $arr[$block->id] = '№'.$block->id.'. '.$block->title;
}
$blocks = $arr;

$attr_checked = [];

// foreach($statuses as $status){
//     if(CriteriaAccess::find()->where(['criteria_id'=>$model->id, 'user_status_id'=>$status->id])->one())    
//         $attr_checked[$status->id] = true;
//     else 
//         $attr_checked[$status->id] = false;
// }

?>


<div class="criteria-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?= $form->field($model, 'block_id')->dropDownList($blocks, ['prompt'=>'выберите блок...'])->label('Блок критериев') ?>
    
    <p>
        <?= Html::a('Редактировать блоки критериев', ['block/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $form->field($model, 'criteria_title')->label('Название критерия')->textInput(['maxlength' => true])?>


    <?= $form->field($model, 'info_point')->label('Информация о баллах')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([null=>'Да', 1=>'Нет'])->label('Критерий активен в текущем году') ?>

    <div class="row">
            <div class="col-lg-6">
				<!-- <h3>Кто может заполнять: </h3> -->
				<?php 

                    // echo  $form->field($criteria_access, 'criteria_id')->checkboxList(UserStatus::find()->select('title')->indexBy('id')->column())->label('Кто может заполнять?');
                    echo $form->field($model, '_accessArray')->checkboxList(ArrayHelper::map(UserStatus::find()->all(), 'id', 'title'), ['separator'=>'<br>'])->label('Кто может заполнять?');
                ?>
			</div>
    </div>



    <?= $form->field($model, 'min_value')->label('Минимальное значение балла критерия(которое больше нуля)')->textInput(['maxlength' => true])?>
    
    <?= $form->field($model, 'max_value')->label('Максимальное значение балла критерия(может совпадать с минимальным)')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
