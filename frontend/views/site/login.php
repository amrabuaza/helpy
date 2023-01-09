<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model LoginForm */

use borales\extensions\phoneInput\PhoneInput;
use common\helper\Constants;
use frontend\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t(Constants::APP, 'login');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?=$form->field($model, "loginType")->hiddenInput(['class'=>"login-type-val"])->label(false)?>

        <?=$form->field($model, 'username')->textInput()?>

        <?=$form->field($model, 'password')->passwordInput()?>

        <?=$form->field($model, 'rememberMe')->checkbox()?>

        <div class="form-group">
            <?=Html::submitButton(Yii::t(Constants::APP, 'login'), ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
        </div>

        <?php ActiveForm::end(); ?>

        <div style="color:#999;margin:1em 0">
            <?=Yii::t(Constants::APP, 'forgot your password')?> <?=Html::a(Yii::t(Constants::APP, 'reset'), ['site/request-password-reset'])?>
            .
            <br>
            <?=Yii::t(Constants::APP, 'need new verification')?> <?=Html::a(Yii::t(Constants::APP, 'resend'), ['site/resend-verification-email'])?>
        </div>


    </div>

</div>
<div class="flex-middle">
    <a href="/site/auth?authclient=facebook" class="facebook-btn">
        <?=Yii::t(
            Constants::APP,
            'login facebook'
        )?> </a>
</div>