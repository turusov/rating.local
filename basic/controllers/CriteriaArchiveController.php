<?php

namespace app\controllers;

use app\models\Criteria;
use app\models\CriteriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\RatingTime;
use app\models\Block;
class CriteriaArchiveController extends Controller
{
  public function actionArchive()
  {
    // $query = sprintf("
    //     select user_data.user_id, sq.is_confirmed from user_data 
    //     inner join 
    //     (select user_id, is_confirmed
    //     from submitted
    //     group by user_id 
    //     ) sq 
    //     on sq.user_id = user_data.user_id
    //     where user_data.department_id = %s", $department);
    // $years=Yii::$app->db->createCommand($query)->queryAll();
    // $years = ArrayHelper::map(RatingTime::find()->all(), 'id', 'name');
    $years = RatingTime::find()->all();
    $criterias = Criteria::find()->where(['is_deleted'=>null])->all();
    $blocks=Block::find()->orderBy('id ASC')->all();
    return $this->render('archive', [
        'criterias'=>$criterias,
        'blocks'=>$blocks,
        'years'=>$years,
    ]);
  }
}

?>
