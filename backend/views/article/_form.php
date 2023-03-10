<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'description')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => ''])?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
