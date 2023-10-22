<?php

namespace app\controllers;

use app\models\pemesanan;
use app\models\pemesananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PemesananController implements the CRUD actions for pemesanan model.
 */
class PemesananController extends Controller
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
     * Lists all pemesanan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new pemesananSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single pemesanan model.
     * @param int $id_pesanan Id Pesanan
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pesanan)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_pesanan),
        ]);
    }

    /**
     * Creates a new pemesanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new pemesanan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_pesanan' => $model->id_pesanan]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing pemesanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pesanan Id Pesanan
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pesanan)
    {
        $model = $this->findModel($id_pesanan);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pesanan' => $model->id_pesanan]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing pemesanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pesanan Id Pesanan
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pesanan)
    {
        $this->findModel($id_pesanan)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the pemesanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pesanan Id Pesanan
     * @return pemesanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pesanan)
    {
        if (($model = pemesanan::findOne(['id_pesanan' => $id_pesanan])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
