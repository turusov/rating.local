<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;
use app\models\Criteria;
use app\models\Block;
$this->title = 'Преподаватели';
$this->params['breadcrumbs'][] = $this->title;


echo '<body class="background">';
// echo '<div class= "teacherlist_container">';
echo '<table class="table table-striped table-bordered">';
echo '<tr><th>№</th><th>ФИО</th><th>Баллы</th><th></th>';
// foreach($criterias as $criteria)
// {
//     echo '<th>';
//     echo $criteria->criteria_title;
//     echo '</th>';
// }
echo '</tr>';

for( $i=0;$i<count($teachers); $i++){
    // echo '<div class = "teacherlist_contain">';
    echo '<tr>';
    echo '<td>'.($i+1).'</td>';
    echo '<td>'.$teachers[$i]->surname.' '.$teachers[$i]->name.' '.$teachers[$i]->patronymic.'</td>';
    echo '<td>'.$teachers[$i]->calculateRating().'</td>'; 
    echo '<td>'; 
    echo '<a class="button-add" href="index.php?r=form%2Ffill-form&user_id='.$teachers[$i]->user_id.'" > Смотреть форму </a>';
    echo '</td>';
    // echo '<td>';
    // if($submitted_confirm_status && $submitted_confirm_status[$teachers[$i]->user_id]!=$confirm_value && $submitted_confirm_status[$teachers[$i]->user_id]!=3){ //если форму не подтверждал этот юзер, и если она не подтверждена в целом
    //     echo ' <a class="button-add" href="index.php?r=teacher%2Fconfirm-form&user_id='.$teachers[$i]->user_id.'&is_confirm='.true.'" > Подтвердить форму</a>';
    // }
    // else{
    //     echo ' <a class="button-add" href="index.php?r=teacher%2Fconfirm-form&user_id='.$teachers[$i]->user_id.'&is_confirm='.False.'" > Отменить подтверждение</a>';
    // }
    // echo '</td>';
    // echo '</div>';
    echo '</tr>';
    }
 
	echo '</table>';
    // echo '</div>';
	echo '</body>';

?>


	


