<?php

namespace app\controllers;

use app\models\Criteria;
use app\models\CriteriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\CriteriaAccess;

/**
 * CriteriaController implements the CRUD actions for Criteria model.
 */
class CriteriaController extends Controller
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
                    ]
                ],
            ]
        );
    }

    /**
     * Lists all Criteria models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CriteriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Criteria model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Criteria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Criteria();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $criteria = Criteria::find()->where(['block_id'=>$model->block_id])->limit(1)->one();
                $criteria_id = $criteria->id;
                $model->criteria_id = $criteria_id;
                if( $model->save())
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
     * Updates an existing Criteria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->_accessArray = ArrayHelper::map(CriteriaAccess::find()->where(['criteria_id' => $id])->all(), 'id', 'user_status_id');
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // $model->_accessArray = ArrayHelper::index($model->_accessArray, 'user_status_id');
            // $model->_accessArray=ArrayHelper::getColumn($model->_accessArray, 'user_status_id');
            $all_acc = CriteriaAccess::find()->where(['criteria_id'=>$model->id])->all();
            if(!is_null($model->_accessArray))
            {
                foreach($all_acc as $i)
                {
                    if(!in_array($i->user_status_id, $model->_accessArray))
                    {
                        $i->delete();
                    }
                }
            }
            foreach($model->_accessArray as $i)
            {
                $acc = CriteriaAccess::findOne(['criteria_id' => $model->id, 'user_status_id' => $i]);
                if(is_null($acc))
                {
                    $CriteriaAccess = new CriteriaAccess();
                    $CriteriaAccess->criteria_id = $model->id;
                    $CriteriaAccess->user_status_id = $i;
                    $CriteriaAccess->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Criteria model.
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
     * Finds the Criteria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Criteria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Criteria::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
