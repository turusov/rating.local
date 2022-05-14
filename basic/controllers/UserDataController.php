<?php

namespace app\controllers;

use Yii;
use Yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\UserData;
use app\models\UserDataSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\models\UserStatus;
use yii\models\User;

/**
 * UserDataController implements the CRUD actions for UserData model.
 */
class UserDataController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['teacher-list'],
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['teacher-list'],
    //                     'matchCallback' => function($rule, $action){
    //                         $access = false;
    //                         if(!Yii::$app->user->isGuest){
    //                             $user = Yii::$app->user->identity;
    //                             $status = $user->getStatusTitle();
    //                             if($status =="zavkav"){
    //                                 $access = true;
    //                             }
    //                         }   
    //                         return $access;
    //                     }   
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all UserData models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserData model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_data_id=-1)
    {
        $model = new UserData();
        if(Yii::$app->user->identity->getStatusTitle() != "admin")
        {
                $user_data_id = UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                if(is_object($user_data_id))
                {
                    return $this->render('view', [
                        'model' => $user_data_id,
                    ]);
                }
                else
                {
                    return $this->redirect(['create']);
                }
            
        }
        else
        {
            return $this->render('view', [
                'model' => $this->findModel($user_data_id),
            ]);
        }
    }


    /**
     * Creates a new UserData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserData();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
