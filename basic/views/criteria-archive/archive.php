<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;

$this->title = 'Архив критериев';
$this->params['breadcrumbs'][] = $this->title;
echo '<body class="background">';

if(!is_null($years)){
    echo 'Критерии за прошлые года:<br>';
    foreach($years as $year){
        echo('<a href="index.php?r=criteria-archive%2Ffor-time&rating_time_id='.$year->id.'">'.$year->name.'</a><br>');
    }
}
echo 'Текущие активные критерии:';
echo '<div class="form-group" style="float:center;">';
    // echo Html::submitButton('Рассчитать рейтинг по текущим критериям', ['class' => 'btn btn-success']);
echo '</div>';
echo '<table class="table table-striped table-bordered">';
echo '<tr><th>№</th><th>Критерий</th><th>Разбалловка</th></tr>';
foreach($blocks as $block){
    echo '<td colspan="6" align="center">'.'Блок № '.$block->id.'. '.$block->title.'</td>';
    for( $i=0;$i<count($criterias); $i++){
        if($criterias[$i]->block_id == $block->id){
            echo '<tr>';
            echo '<td>'.$criterias[$i]->block_id.'.'.$criterias[$i]->criteria_id.'</td>';
            echo '<td>'.$criterias[$i]->criteria_title.'</td>';
            echo '<td>'.$criterias[$i]->info_point.'</td>'; 
        }
        echo '</tr>';
    }
}
echo '</table>';
echo '</body>';
?>


	


