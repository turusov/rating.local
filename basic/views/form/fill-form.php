<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;
use yii\widgets\Pjax;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;

echo '<body class="background">';;
echo '<table class="table table-dark table-hover">';
echo '<tr><th>№</th><th>Критерий</th><th>Разбалловка</th><th>Индивидуальный балл</th></tr>';
// foreach($criterias as $criteria ){
//     echo '<tr>';
//     echo '<td>'.$criteria->criteria.'</td>';
//     echo '<td>'.$criteria->info_point.'</td>'; 
//     echo '<td>';
//     $form = ActiveForm::begin(['action'=>'index.php?r=form%2Fform-process']); 
//     echo  $form->field($model, 'value')->label("Балл");
//     echo  $form->field($model, 'criteria_id')->hiddenInput(['value'=> $criteria->id])->label(false);
//     echo '<td>';
//     echo '<div class="form-group margin-fix">';
//     echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);
//     echo '</div>';
//     echo '</td>';
//     ActiveForm::end();
//         echo '</td>';
//         echo '</tr>';
//     }

// for($block_id = 0 ; $block_id < count($order); $block_id++){
//     echo $block_id;
// }


foreach($blocks as $block){
    echo '<td colspan="5" align="center">'.'Блок № '.$block->id.'. '.$block->title.'</td>';
    for( $i=0;$i<count($criterias); $i++){
        if($criterias[$i]->block_id == $block->id){
            echo '<tr>';
            echo '<td>'.$criterias[$i]->block_id.'.'.$criterias[$i]->criteria_id.'</td>';
            echo '<td>'.$criterias[$i]->criteria_title.'</td>';
            echo '<td>'.$criterias[$i]->info_point.'</td>'; 
            echo '<td>';
            $form = ActiveForm::begin(['action'=>'index.php?r=form%2Fform-process']); 
            echo  $form->field($model[$i], 'value')->label("Балл"); 
            echo  $form->field($model[$i], 'criteria_id')->hiddenInput(['value'=> $criterias[$i]->id])->label(false);
            echo '<input type="hidden" name="id" value="'.$model[$i]->id.'">';
            echo '<td>';
            echo '<div class="form-group margin-fix">';
            echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);
            echo '</div>';
            echo '</td>';
            ActiveForm::end();
                echo '</td>';
            }
        }
        echo '</tr>';
}

 
	echo '</table>';
	echo '</body>';
?>


	


