<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Department;
use app\models\Faculty;
/* @var $this yii\web\View */
/* @var $model app\models\UserData */

$this->title = 'Информация';
$this->params['breadcrumbs'][] = ['label' => 'User Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$d = Department::find()->where(['id'=>$model->faculty_id])->all(); //кафедры
$f = Faculty::find()->all();
?>
<div class="user-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        ],
    ]) ?>

</div>
