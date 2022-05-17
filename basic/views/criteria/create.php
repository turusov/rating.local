<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Criteria */

$this->title = 'Создать критерий';
$this->params['breadcrumbs'][] = ['label' => 'Критерии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="criteria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
