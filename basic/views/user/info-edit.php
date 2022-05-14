<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\UserData;

$this->title = 'Редактирование информации';
$this->params['breadcrumbs'][] = ['label' => 'Анкета', 'url' => ['users']];
$this->params['breadcrumbs'][] = $this->title;
// Normal select with ActiveForm & model

?>