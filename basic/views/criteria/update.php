<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Criteria */

$this->title = 'Update Criteria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Criterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="criteria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
