<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;

$this->title = 'Преподаватели';
$this->params['breadcrumbs'][] = $this->title;


echo '<body class="background">';;
echo '<table class="table table-dark table-hover">';
echo '<tr><th>№</th><th>ФИО</th><th>Баллы</th><th></th><th></th></tr>';


for( $i=0;$i<count($users); $i++){
    echo '<tr>';
    echo '<td>'.($i+1).'</td>';
    echo '<td>'.$users[$i]->surname.' '.$users[$i]->name.' '.$users[$i]->patronymic.'</td>';
    echo '<td>'.$users[$i]->calculateRating().'</td>'; 
    echo '<td>'; 
    echo ' <a class="button-add" href="index.php?r=form%2Ffill-form&user_id='.$users[$i]->user_id.'" > Смотреть форму </a>';
    echo '</td>';
    echo '<td>';
    // if($submitted_confirm_status && $submitted_confirm_status[$users[$i]->user_id]!=$confirm_value && $submitted_confirm_status[$users[$i]->user_id]!=3){ //если форму не подтверждал этот юзер, и если она не подтверждена в целом
    //     echo ' <a class="button-add" href="index.php?r=teacher%2Fconfirm-form&user_id='.$users[$i]->user_id.'&is_confirm='.true.'" > Подтвердить форму</a>';
    // }
    // else{
    //     echo ' <a class="button-add" href="index.php?r=teacher%2Fconfirm-form&user_id='.$users[$i]->user_id.'&is_confirm='.False.'" > Отменить подтверждение</a>';
    // }
    echo '</td>';
    echo '</tr>';
    }
 
	echo '</table>';
	echo '</body>';

?>


	


