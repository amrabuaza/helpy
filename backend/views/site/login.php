<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$user = Yii::$app->dynamicLogin->GetUserFromCookie();

?>

<div class="login-box">
    <div class="login-logo">
        Helpy
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in as admin</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?=$form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')])?>

        <?=$form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])?>

        <div class="row">
            <div class="col-lg-12">
                <?=Html::submitButton('Sign in', ['class' => 'btn btn-primary w100 btn-block btn-flat', 'name' => 'login-button'])?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
        <br/>
        <?php if ($user != null) {
        ?>
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-Login',
            'action' => '/site/dynamic-login',
        ]); ?>
        <?=Html::submitButton("Sign in " . $user->username, ['class' => 'btn btn-primary w100 btn-block btn-flat', 'name' => 'login-button'])?>
        <?php ActiveForm::end(); ?>
    </div><!-- /.login-box -->
    <?php } ?>
</div>
<!-- /.login-box-body -->
</div><!-- /.login-box -->
