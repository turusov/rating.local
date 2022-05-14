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
    public function actionFillForm()
    {
        if (isset($_GET['user_id'])){
            $user_id = ($_GET['user_id']);
        }
        else
            $user_id = Yii::$app->user->identity->id;
        
        $criterias=Criteria::find()->where(['is_deleted'=>NULL])->all(); 
        $blocks=Block::find()->orderBy('id ASC')->all();
        $submitteds = Submitted::find()->where(['user_id'=>$user_id])->all();

        // return gettype($submitteds);
        for($i=0; $i<count($criterias); $i++)
        {
            $flag = False;
            foreach($submitteds as $submitted)
            { 
                if($submitted->criteria_id==$criterias[$i]->id){
                    $flag = True;
                    break;
                }
            }
            if(!$flag)
            {
                $sub = new Submitted();
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

        return $this->render('fill-form', ['submitteds' => $submitteds, 'criterias' => $criterias, 'blocks' => $blocks]);

    }

}
?>