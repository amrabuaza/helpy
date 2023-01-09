<?php

use common\models\translation\ArticleLanguage;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ArticleLanguage */
/* @var $form yii\widgets\ActiveForm */

$articleName = $model->article->title;
$this->title = "Mange ( $articleName ) Translations";
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $articleName, 'url' => ['view', 'id' => $model->article_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="sub-category-translations-form col-sm-4 col-lg-6">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, "language")->hiddenInput()->label(false)?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'description')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>
</div>