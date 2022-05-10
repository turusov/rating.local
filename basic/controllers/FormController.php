<?php 

namespace app\controllers;
use Yii;
use Yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Signup;
use app\models\Login;
use app\models\Criteria;
use app\models\Submitted;
use app\models\Block;

class FormController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['fillform', 'form-process'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['fillform', 'form-process'],
                        'matchCallback' => function($rule, $action){
                            $access = false;
                            if(!Yii::$app->user->isGuest){
                                $user = Yii::$app->user->identity;
                                $status = $user->getStatusTitle();
                                if($status == "teacher" || $status =="zavkav"){
                                    $access = true;
                                }
                            }
                            return $access;
                        }   
                    ],
                ],
            ],
        ];
    }
    // public function actionFillform()
    // {
    //     if (isset($_GET['user_id'])){
    //         $user_id = ($_GET['user_id']);
    //     }
    //     else
    //         $user_id = Yii::$app->user->identity->id;

    //     $criterias=Criteria::find()->all(); 
    //     $blocks=Block::find()->orderBy('id ASC')->all();
    //     $order = array(array());
    //     for($i = 0 ; $i<count($blocks); $i++){
    //         foreach($criterias as $criteria){
    //             if($criteria->block_id == $i){
    //                 array_push($order, $criteria->criteria_id);
    //             }
    //         }
    //     }
    //     $model = [];
    //     foreach($criterias as $criteria){
    //         $submitted = Submitted::find()->where([
    //             'criteria_id' => $criteria->id, 
    //             'user_id' => $user_id,
    //             ])->limit(1)->one();
    //         if(!is_object($submitted)){
    //             $submitted = new Submitted();
    //         }
    //         array_push($model, $submitted);
    //     }
    //     return $this->render('fill-form', ['criterias' => $criterias, 'blocks' => $blocks, 'order'=>$order ,'model' => $model]);
    // }
    public function actionFillform()
    {
        if (isset($_GET['user_id'])){
            $user_id = ($_GET['user_id']);
        }
        else
            $user_id = Yii::$app->user->identity->id;

        $criterias=Criteria::find()->all(); 
        $blocks=Block::find()->orderBy('id ASC')->all();
        $order = array(array());
        for($i = 0 ; $i<count($blocks); $i++){
            foreach($criterias as $criteria){
                if($criteria->block_id == $i){
                    array_push($order, $criteria->criteria_id);
                }
            }
        }
        $sub = Model::find()->indexBy('1')->all();

        foreach($criterias as $criteria){
            $submitted = Submitted::find()->where([
                'criteria_id' => $criteria->id, 
                'user_id' => $user_id,
                ])->limit(1)->one();
            if(!is_object($submitted)){
                $submitted = new Submitted();
            }
            array_push($model, $submitted);
        }

        return $this->render('fill-form', ['criterias' => $criterias, 'blocks' => $blocks, 'order'=>$order ,'model' => $model]);
    }

    // public function actionFormProcess()
    // {
    //     if (is_numeric($_POST['id'])){
    //         $model=Submitted::find()->where("id=".$_POST['id'])->one();
    //     }
    //     else{
    //         $model = new Submitted();
    //     }
    //     $model->load(\Yii::$app->request->post());
    //     $model->user_id = Yii::$app->user->identity->id;
    //     $model->save(); 
    //     return $this->redirect("index.php?r=form%2Ffillform");
    // }

}
?>