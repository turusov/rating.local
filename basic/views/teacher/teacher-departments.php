<?php
use yii\helpers\Html;
use yii\helpers\GridView;
use yii\widgets\ActiveForm;
use app\models\Submitted;
use app\models\Criteria;
use app\models\Block;
$this->title = 'Кафедры';
$this->params['breadcrumbs'][] = $this->title;


echo '<body class="background">';
echo '<h1>Кафедры</h1>';
echo '<table class="table table-striped table-bordered">';
echo '<tr><th>Название</th>';
echo '</tr>';

foreach($departments as $department){
    echo '<tr>';
    echo('<td><a href="index.php?r=teacher%2Fteacher-list&department='.$department->id.'">'.$department->title.'</a><br></td>');
    echo '</tr>';
    }
	echo '</table>';
	echo '</body>';

?>


	


