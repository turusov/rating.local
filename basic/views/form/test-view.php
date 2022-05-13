<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;

echo '<body class="background">';;
echo '<table class="table table-dark table-hover">';
echo '<tr><th>№</th><th>Критерий</th><th>Разбалловка</th><th>Индивидуальный балл</th></tr>';
$form = ActiveForm::begin();



foreach($blocks as $block){
    echo '<td colspan="5" align="center">'.'Блок № '.$block->id.'. '.$block->title.'</td>';
    for( $i=0;$i<count($criterias); $i++){
        if($criterias[$i]->block_id == $block->id){
            echo '<tr>';
            echo '<td>'.$criterias[$i]->block_id.'.'.$criterias[$i]->criteria_id.'</td>';
            echo '<td>'.$criterias[$i]->criteria_title.'</td>';
            echo '<td>'.$criterias[$i]->info_point.'</td>'; 
            for($j=0; $j<count($submitteds); $j++){
                if($criterias[$i]->id == $submitteds[$j]->criteria_id){
                    echo '<td>';
                    echo $form->field($submitteds[$j], "[$j]value")->label('Балл');
                    echo  $form->field($submitteds[$j], 'criteria_id')->hiddenInput(['value'=> $criterias[$i]->id])->label(false);
                    echo '<input type="hidden" name="id" value="'.$submitteds[$j]->id.'">';
                    echo '<td>';
                    break;
                }   
            }
            echo '<td>';
            echo '</td>';
        }
        echo '</tr>';
    }
}

// foreach ($submitteds as $index => $submitted) {
//     echo '<tr>';
//     echo '<td>';
//     echo $index;
//     echo '</td>';
//     echo '<td>';
//     echo $criterias[$submitted->criteria_id-1]->criteria_title;
//     echo '</td>';
//     echo '<td>';
//     echo $criterias[$submitted->criteria_id-1]->info_point;
//     echo '</td>';
//     echo '<td>';
//     echo $form->field($submitted, "[$index]value")->label('Балл');
//     echo '</td>';
//     echo '</tr>';
// }
echo '</table>';
echo '<div class="form-group margin-fix">';
echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);
echo '</div>';
echo '</body>';
ActiveForm::end();

// $form = ActiveForm::begin();
?>


	


