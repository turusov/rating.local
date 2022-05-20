<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Block;
use app\models\CriteriaAccess;
use app\models\UserStatus;
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
            [
                'label'=> 'Блок',
                'attribute'=> 'block_id',
                // 'value'=> Block::getBlockName($block_id)
                'value'=> function($model){
                    return '№'.$model->block_id.' '.Block::getBlockName($model->block_id);
                }
            ],
            [
                'label'=> 'Активен в текущем году',
                'attribute'=>'is_deleted',
                'value'=> function($model){
                    if(is_null($model->is_deleted))
                        return 'Да';
                    else 
                        return 'Нет';
                }
            ], 
            [
                'attribute' => 'criteria_access',
                'label' => 'Кто может заполнять',
                'value' => function($model)
                {
                    $statuses = CriteriaAccess::find()->where(['criteria_id'=>$model->id])->all();
                    $str = '';
                    foreach($statuses as $status)
                    {
                        // array_push($arr, UserStatus::getStatusName($status));
                        if(!empty($str))
                            $str.=', ';
                        $str.=UserStatus::getStatusName($status);
                    }
                    return $str;
                }
            ],
            //'block_id',
            //'min_value', 
            //'max_value',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
