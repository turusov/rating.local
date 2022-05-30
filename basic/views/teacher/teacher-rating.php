<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;
use app\models\Criteria;
use app\models\Block;
$this->title = 'Рейтинг';
$this->params['breadcrumbs'][] = $this->title;


echo '<body class="background">';
echo '<h1>Рейтинг за текущий год:</h1>';
echo '<table class="table table-striped table-bordered">';
echo '<tr><th>№</th><th>ФИО</th><th>Баллы</th>';
echo '</tr>';

for( $i=0;$i<count($teachers); $i++){
    echo '<tr>';
    echo '<td>'.($i+1).'</td>';
    echo '<td>'.$teachers[$i]->surname.' '.$teachers[$i]->name.' '.$teachers[$i]->patronymic.'</td>';
    echo '<td>'.$teachers[$i]->calculateRating().'</td>'; 
    echo '</tr>';
    }
 
	echo '</table>';
	echo '</body>';

?>


	


