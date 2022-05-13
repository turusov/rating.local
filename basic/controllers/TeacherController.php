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
use app\models\User;
use app\models\UserData;
use app\models\Block;

class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['teacher-list'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['teacher-list'],
                        'matchCallback' => function($rule, $action){
                            $access = false;
                            if(!Yii::$app->user->isGuest){
                                $user = Yii::$app->user->identity;
                                $status = $user->getStatusTitle();
                                if($status =="zavkav"){
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
    public function actionTeacherList()
    {
        $model = [];
        $faculty=UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->faculty_id;
        $users=UserData::find()->where(['faculty_id' => $faculty])->all();
        return $this->render('teacher-list', ['users'=>$users]);
    }
}

?>