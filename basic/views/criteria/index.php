<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CriteriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Критерии ЭК';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="criteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новый критерий', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'criteria_id',
            'criteria_title',
            'info_point',
            'access',
            'is_deleted',
            //'block_id',
            //'min_value', 
            //'max_value',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
