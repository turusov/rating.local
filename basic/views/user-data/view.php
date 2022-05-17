<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Department;
use app\models\Faculty;
/* @var $this yii\web\View */
/* @var $model app\models\UserData */

$this->title = 'Личный кабинет';
// $this->params['breadcrumbs'][] = ['label' => 'Список пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$d = Department::find()->where(['id'=>$model->faculty_id])->all(); //кафедры
$f = Faculty::find()->all();
?>
<div class="user-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'surname',
            'patronymic',
            [
                'label'=> 'Факультет',
                'attribute'=>'faculty_id',
                'value'=> Faculty::getFacultyTitle($model->faculty_id)
            ], 
            [
                'label'=> 'Кафедра',
                'attribute'=>'department_id',
                'value'=> Department::getDepartmentTitle($model->department_id)
            ], 
            [
                'label'=> 'Ученое звание',
                'attribute'=>'academic_rank',
            ], 
            [
                'label'=> 'Ставка',
                'attribute'=>'work_rate',
            ], 
        ],
    ]) ?>

</div>
