<?php

namespace backend\controllers;

use common\controllers\Controller;
use common\helper\Constants;
use common\models\translation\CategoryLanguage;
use common\models\user\AdminCategory;
use common\models\user\UserRoles;
use Yii;
use common\models\Category;
use common\models\search\CategorySearch;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{

    protected function rules()
    {
        return UserRoles::ADMIN_ROLES;
    }


    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->status = Constants::ACTIVE;
        $modelAr = new CategoryLanguage();
        if ($model->load(Yii::$app->request->post(), 'Category')
            && $model->save()
            && $modelAr->load(Yii::$app->request->post(), 'CategoryLanguage')) {
            $modelAr->category_id = $model->id;
            $modelAr->language = "ar";
            $modelAr->save();
            $adminCategory = new AdminCategory();
            $adminCategory->category_id = $model->id;
            $adminCategory->user_id = $model->user_id;
            $adminCategory->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelAr' => $modelAr
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateTranslations($id, $language)
    {
        $model = CategoryLanguage::findOne(["main_category_id" => $id, Constants::LANGUAGE => $language]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('translations', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
