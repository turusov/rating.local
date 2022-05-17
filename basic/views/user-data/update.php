<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserData */

$this->title = 'Редактировать: ' .$model->surname.' '.$model->name.' '.$model->patronymic;
// $this->params['breadcrumbs'][] = ['label' => 'Список пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->surname.' '.$model->name.' '.$model->patronymic, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="user-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
