<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RequestAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'content')->widget(alexantr\ckeditor\CKEditor::className(), [
        'clientOptions' => [
            'extraPlugins' => 'autogrow,colorbutton,colordialog,iframe,justify,showblocks',
            'removePlugins' => 'resize',
            'autoGrow_maxHeight' => 900,
            'stylesSet' => [
                ['name' => 'Subscript', 'element' => 'sub'],
                ['name' => 'Superscript', 'element' => 'sup'],
            ],
        ],
    ])?>

    <?=$form->field($model, 'request_id')->hiddenInput()->label(false)?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
