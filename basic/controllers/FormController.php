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

class FormController extends \yii\web\Controller
{
    public function actionFillform()
    {
        $criterias=Criteria::find()->all(); 
        $model = [];
        foreach($criterias as $criteria){
            $submitted = Submitted::find()->where([
                'criteria_id' => $criteria->id, 
                'user_id' => Yii::$app->user->identity->id,
                ])->limit(1)->one();
            if(!is_object($submitted)){
                $submitted = new Submitted();
            }
            array_push($model, $submitted);
        }
        return $this->render('fill-form', ['criterias' => $criterias, 'model' => $model]);
    }
    /*
    public function actionFillform()
    {
        $submitted=Submitted::find()->indexBy('id')->all(); 

        if (Model::loadMultiple($submitted, Yii::$app->request->post()) && Model::validateMultiple($criterias)) {
            foreach ($criterias as $criteria) {
                $criteria->save(false);
            }
            return $this->redirect('index');
        }
        
        return $this->render('fill-form', ['criterias' => $criterias]);
    }
    */
    public function actionFormProcess()
    {
        if (isset($_POST['id'])){
            $model=Submitted::find()->where("id=".$_POST['id'])->one();
        }
        else{
            $model = new Submitted();
        }
        $model->load(\Yii::$app->request->post());
        $model->user_id = Yii::$app->user->identity->id;
        $model->save(); 
        return $this->redirect("index.php?r=form%2Ffillform");
    }
}