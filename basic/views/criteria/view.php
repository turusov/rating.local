<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Department;
/* @var $this yii\web\View */
/* @var $model app\models\Criteria */

$this->title = $model->criteria_title;
$this->params['breadcrumbs'][] = ['label' => 'Критерии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="criteria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'criteria_id',
            'criteria_title',
            'info_point',
            'is_deleted',
            // [
            //     'label'=>'Кафедра',
            //     'attribute'=> 'department_id',
            //     'value'=> Department::getDepartmentName($department_id)
            // ],
            'min_value',
            'max_value',
        ],
    ]) ?>

</div>
