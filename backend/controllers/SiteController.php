<?php

namespace backend\controllers;

use common\controllers\Controller;
use common\models\Article;
use common\models\Category;
use common\models\Request;
use common\models\RequestAnswer;
use common\models\user\User;
use Yii;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    protected function userActions()
    {
        return ['logout', 'index'];
    }

    protected function guestActions()
    {
        return ['login', 'dynamic-login'];
    }

    protected function verbs()
    {
        return [
            'logout' => ['post'],
            'dynamic-login' => ['post'],
        ];
    }

    public function actionError()
    {
        return $this->render('error');
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $requestCount        = Request::find()->count();
        $articleCount        = Article::find()->count();
        $answerCount         = RequestAnswer::find()->count();
        $pendingRequestCount = Request::find()->where(['answered_at' => null])->count();

        return $this->render('index', [
            'requestCount'        => $requestCount,
            'articleCount'        => $articleCount,
            'answerCount'         => $answerCount,
            'pendingRequestCount' => $pendingRequestCount
        ]);
    }

    /**
     * Login action.
     *
     * @return \yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->type = [User::TYPE_ADMIN, User::TYPE_ROOT];
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->dynamicLogin->SaveAccessToken();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionDynamicLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = Yii::$app->dynamicLogin->GetUserFromCookie();
        Yii::$app->user->login($user);
        return $this->goBack();
    }

    /**
     * Logout action.
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
