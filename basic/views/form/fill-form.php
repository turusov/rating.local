<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;

$this->title = 'Заполнить форму';
$this->params['breadcrumbs'][] = $this->title;
echo '<body class="background">';;
echo '<table class="table table-striped table-bordered">';
echo '<tr><th>№</th><th>Критерий</th><th>Разбалловка</th><th>Индивидуальный балл</th></tr>';


$form = ActiveForm::begin();
foreach($blocks as $block){
    echo '<td colspan="6" align="center">'.'Блок № '.$block->id.'. '.$block->title.'</td>';
    for( $i=0;$i<count($criterias); $i++){
        if($criterias[$i]->block_id == $block->id){
            echo '<tr>';
            echo '<td>'.$criterias[$i]->block_id.'.'.$criterias[$i]->criteria_id.'</td>';
            echo '<td>'.$criterias[$i]->criteria_title.'</td>';
            echo '<td>'.$criterias[$i]->info_point.'</td>'; 
            for($j=0; $j<count($submitteds); $j++){
                if($criterias[$i]->id == $submitteds[$j]->criteria_id){
                    $val = null;
                    if(is_numeric($submitteds[$j]->value)){
                        $val = $submitteds[$j]->value;
                    }
                    $submitteds[$j]->value = $val;
                    // in_array($user_status_id, $access[$criterias[$i]->id])
                    $allowed = False;
                    foreach($access as $a)
                    {
                        if($a->criteria_id == $criterias[$i]->id){
                            $allowed = True; //выведет Form для данного критерия если он есть в массиве access
                        }
                    }
                    if(!$is_confirmed && $allowed)
                    {   
                        echo '<td style = background-color:#e3fbe3>';
                        echo $form->field($submitteds[$j], "[$j]value")->label('Балл');
                        echo  $form->field($submitteds[$j], 'criteria_id')->hiddenInput(['value'=> $criterias[$i]->id])->label(false);
                        echo '<input type="hidden" name="id" value="'.$submitteds[$j]->id.'">';
                    }
                    else
                    {
                        echo '<td style = background-color:gray>';
                        if(is_null($val))
                            echo 'Не заполнено';
                        else 
                            echo $val;
                    }
                }   
                echo '</td>';
            }
        }
        echo '</tr>';
    }
}
echo '</table>';
if(!$is_confirmed){
    echo '<div class="form-group" style="float:right;">';
    echo Html::submitButton('Подтвердить', ['class' => 'btn btn-success']);
    echo '</div>';
}
echo '</body>';
ActiveForm::end();
?>


	


