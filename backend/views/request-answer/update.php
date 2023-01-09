<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RequestAnswer */

$this->title = Yii::t('app', 'Update Request Answer: {name}', [
    'name' => $model->request->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
