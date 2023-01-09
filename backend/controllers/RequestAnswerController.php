<?php

namespace backend\controllers;

use common\controllers\Controller;
use common\models\Request;
use common\models\RequestAnswer;
use common\models\search\RequestAnswerSearch;
use common\models\user\UserRoles;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * RequestAnswerController implements the CRUD actions for RequestAnswer model.
 */
class RequestAnswerController extends Controller
{
    protected function rules()
    {
        return UserRoles::ADMIN_ROLES;
    }

    /**
     * Lists all RequestAnswer models.
     * @return mixed
     */
    public function actionIndex($request_id)
    {
        $request      = Request::findOne($request_id);
        $searchModel  = new RequestAnswerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $request_id);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'request'      => $request,
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($request_id)
    {
        $model              = new RequestAnswer();
        $model->answered_by = Yii::$app->user->id;
        $model->request_id  = $request_id;
        if ($model->load(Yii::$app->request->post(), 'RequestAnswer') && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'request_id' => $request_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequestAnswer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'request_id' => $model->request_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single RequestAnswer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $request_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'request_id' => $request_id
        ]);
    }

    /**
     * Deletes an existing RequestAnswer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id, $request_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'request_id' => $request_id]);
    }

    /**
     * Finds the RequestAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestAnswer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}