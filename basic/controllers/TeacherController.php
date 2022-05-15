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
                                if($status =="zavkaf" || $status == 'dekanat'){
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
        $query = sprintf("
        select user_data.*, sq.is_confirmed from user_data 
            inner join 
            (select user_id, is_confirmed
                from submitted
                group by user_id 
                ) sq 
            on sq.user_id = user_data.user_id
        where user_data.faculty_id = %s", $faculty);
        //$users=UserData::find()->where(['faculty_id' => $faculty])->all();
        $users=Yii::$app->db->createCommand($query)->queryAll();
        return (var_dump($users));
        return $this->render('teacher-list', ['users'=>$users]);
    }

    public function actionConfirmForm()
    {
        if (isset($_GET['user_id'])){
            $user_id = ($_GET['user_id']);
        }
        $submitteds = Submitted::find()->where(['user_id'=>$user_id])->all();
        $status = Yii::$app->user->identity->getStatusTitle();
        if($status == 'dekanat')
        {
            $value = 1;
        }
        else if ($status == 'zavkaf')
        {
            $value = 2;
        }
        if (Model::validateMultiple($submitteds))
        {
            foreach($submitteds as $submitted)
            {
                if(is_null($submitted->is_confirmed)) //если не подтверждена совсем
                    $submitted -> is_confirmed = $value;
                else
                    if($submitted->is_confirmed != $value) //если ее не еще раз подтверждают
                        $submitted -> is_confirmed = 3;

                $submitted -> save();
            }
        }
        return $this->redirect('index.php?r=teacher%2Fteacher-list');
    }
}

?>