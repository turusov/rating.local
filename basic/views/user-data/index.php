<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список пользователей';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'name',
            'surname',
            'patronymic',
            'department_id',
            'faculty_id',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, UserData $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
