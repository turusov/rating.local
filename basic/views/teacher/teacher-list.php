<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;

$this->title = 'Teachers';
$this->params['breadcrumbs'][] = $this->title;


echo '<body class="background">';;
echo '<table class="table table-dark table-hover">';
echo '<tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th></th></tr>';


for( $i=0;$i<count($users); $i++){
    echo '<tr>';
    echo '<td>'.$users[$i]->surname.'</td>';
    echo '<td>'.$users[$i]->name.'</td>'; 
    echo '<td>'.$users[$i]->patronymic.'</td>'; 
    echo '<td>'; 
    echo ' <a class="button-add" href="index.php?r=form%2Ffill-form&user_id='.$users[$i]->user_id.'" > Смотреть форму </a>';
    echo '</div>';
    echo '</td>';
    echo '</tr>';
    }
 
	echo '</table>';
	echo '</body>';

?>


	


