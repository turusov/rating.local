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
use app\models\ArraySubmitted;
use app\models\CriteriaAccess;
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
                                if($status == "teacher" || $status =="zavkaf"){
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
    public function actionFillForm()
    {
        if (isset($_GET['user_id'])){
            $user_id = ($_GET['user_id']);
        }
        else{
            $user_id = Yii::$app->user->identity->id;
        }
        $user_status_id = Yii::$app->user->identity->user_status_id;
        if (!isset($_GET['user_id'])){  // если завкаф нажал на кнопку заполнить свою форму, будет заполнять как преподаватель
            if($user_status_id==3){
                $user_status_id=4;
            }
        }
        $access = CriteriaAccess::find()->where(['user_status_id'=>[$user_status_id]])->orderBy('criteria_id ASC')->all();//найдет в таблице пересечений criteria_access критерии которые можно заполнить.
        $criterias=Criteria::find()->where(['is_deleted'=>NULL])->all(); 
        $blocks=Block::find()->orderBy('id ASC')->all();
        $submitteds = Submitted::find()->where(['user_id'=>$user_id])->all();
        // return (var_dump($user_status_id));
        // return (var_dump($access));
        $is_confirmed = False; //подтверждена ли форма
        if(!is_null($submitteds) && count($submitteds))
        {
            if($submitteds[0]->is_confirmed == 3)// если его форму подтвердили, она закроется 
            {
                $is_confirmed = True;
            }
        }
        for($i=0; $i<count($criterias); $i++)
        {
            $exists = False;
            foreach($submitteds as $submitted)
            { 
                if($submitted->criteria_id==$criterias[$i]->id){
                    $exists = True;
                    break;
                }
            }
            if(!$exists)
            {
                $sub = new Submitted();
                $sub->value = null;
                $sub->user_id = $user_id;
                $sub->criteria_id = $criterias[$i]->id;
                array_push($submitteds, $sub);
            }
        }
        

        if (Model::loadMultiple($submitteds, Yii::$app->request->post()) && Model::validateMultiple($submitteds)) {
            foreach ($submitteds as $submitted) {
                $submitted->save();
            }
        }   
        return $this->render('fill-form', ['submitteds' => $submitteds, 'criterias' => $criterias, 'user_status_id'=>$user_status_id, 'blocks' => $blocks,'access'=>$access, 'is_confirmed' => $is_confirmed]);

    }

}
?>