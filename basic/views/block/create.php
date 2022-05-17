<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Block */

$this->title = 'Добавить блок критериев';
$this->params['breadcrumbs'][] = ['label' => 'Блоки критериев', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
