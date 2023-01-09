<?php

/* @var $this yii\web\View */
/* @var $model common\models\RequestAnswer */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;

$this->title = Yii::t('app','request_answer.create')
?>

<div class="request-answer-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
