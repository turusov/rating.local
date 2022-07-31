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
use app\models\Department;
use yii\helpers\ArrayHelper;
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
        if (isset($_GET['department'])){
            $department = ($_GET['department']);
        }
        else{
            $department=UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->department_id;
        }
        $teachers=UserData::find()->where(['department_id' => $department])->all();
        $criterias=Criteria::find()->where(['is_deleted'=>NULL])->all(); 
        $blocks=Block::find()->orderBy('id ASC')->all();
        // $ids = [];
        // foreach($users as $user){
        //     array_push($ids, $user->user_id);
        // }       
        // $submitteds = Submitted::find()->where(['user_id' => $ids])->one(); 
        $query = sprintf("
        select user_data.user_id, sq.is_confirmed from user_data 
        inner join 
        (select user_id, is_confirmed
        from submitted
        group by user_id 
        ) sq 
        on sq.user_id = user_data.user_id
        where user_data.department_id = %s", $department);
        $submitteds=Yii::$app->db->createCommand($query)->queryAll();
        // return var_dump($submitteds[0]);
        $submitted_confirm_status = [];

        foreach($teachers as $teacher){
            foreach($submitteds as $submitted){
                if($submitted['user_id'] == $teacher->user_id){
                    $submitted_confirm_status[$teacher->user_id] = $submitted['is_confirmed'];
                }
            }
        }

        $confirm_value = Yii::$app->user->identity->getConfirmValue();

        // return var_dump($is_confirmed);
        return $this->render('teacher-list', ['teachers'=>$teachers, 'criterias'=> $criterias, 'blocks'=> $blocks, 'submitted_confirm_status'=>$submitted_confirm_status, 'confirm_value'=>$confirm_value]);
    }

    public function actionConfirmForm()
    {
        if (isset($_GET['user_id'])){
            $user_id = ($_GET['user_id']);
        }
        if (isset($_GET['is_confirm'])){
            $is_confirm = ($_GET['is_confirm']);
        }
        $submitteds = Submitted::find()->where(['user_id'=>$user_id])->all();
        $confirm_value = Yii::$app->user->identity->getConfirmValue();
        if (Model::validateMultiple($submitteds))
        {
            foreach($submitteds as $submitted)
            {
                if($is_confirm)
                    $submitted->is_confirmed += $confirm_value;
                else 
                    $submitted->is_confirmed -= $confirm_value;
                $submitted->save();
            }
        }
        return $this->redirect('index.php?r=teacher%2Fteacher-list');
    }
    public function actionTeacherRating()
    {
        $department=UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->department_id;
        $teachers=UserData::find()->where(['department_id' => $department])->all();
        usort($teachers, function ($l, $r){
            return  ($l->calculateRating() < $r->calculateRating());
        }
        );
        return $this->render('teacher-rating', ['teachers'=>$teachers]);
    }
    public function actionTeacherDepartments()
    {
        $faculty = 1;
        $departments=Department::find()->where(['faculty_id'=>$faculty])->all();
        return $this->render('teacher-departments', ['departments' => $departments]);
    }
}

?>