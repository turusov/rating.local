<?php
	use app\models\UserData;

	$this->title = 'Личный кабинет';
	$this->params['breadcrumbs'][] = $this->title;
	echo '<br>';
	echo '<br>';
	echo '<body class="background">';
	echo '<table class="table table-dark table-hover">';
	echo '<tr>';
		echo '<td>Фамилия:</td><td>'.$data->name.'</td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>Имя:</td><td>'.$data->surname.'</td>';
	echo '</tr>';
	
		
	
	echo '</table>';

	echo '<a href="index.php?r=user%2Fedit-info&user='.$data->user_id.'" class="btn btn-warning"> Редактировать </a>';


?>