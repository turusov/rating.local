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

class FormController extends \yii\web\Controller
{
    public function actionFillform()
    {
        //$fillform_model = new FillForm();
        return $this->render('fill-form');
    }
}