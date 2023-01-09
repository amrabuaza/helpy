<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use common\helper\Constants;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t(Constants::APP, 'contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Yii::t(Constants::APP, 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?=$form->field($model, 'name')->textInput(['autofocus' => true])?>

            <?=$form->field($model, 'email')?>

            <?=$form->field($model, 'subject')?>

            <?=$form->field($model, 'body')->textarea(['rows' => 6])?>

            <?=$form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label(false)?>
            <div class="form-group">
                <?=Html::submitButton(Yii::t(Constants::APP, 'submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button'])?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
