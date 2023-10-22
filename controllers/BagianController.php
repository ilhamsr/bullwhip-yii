<?php

namespace app\controllers;

use app\models\bagian;
use app\models\bagianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BagianController implements the CRUD actions for bagian model.
 */
class BagianController extends Controller
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

    /**
     * Lists all bagian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new bagianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single bagian model.
     * @param int $id_bagian Id Bagian
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_bagian)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_bagian),
        ]);
    }

    /**
     * Creates a new bagian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new bagian();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_bagian' => $model->id_bagian]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing bagian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_bagian Id Bagian
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_bagian)
    {
        $model = $this->findModel($id_bagian);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_bagian' => $model->id_bagian]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing bagian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_bagian Id Bagian
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_bagian)
    {
        $this->findModel($id_bagian)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the bagian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_bagian Id Bagian
     * @return bagian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_bagian)
    {
        if (($model = bagian::findOne(['id_bagian' => $id_bagian])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
