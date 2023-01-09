<?php

use common\helper\Constants;
use common\models\Request;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Request */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="main-category-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="flex justify-content-end mb24">
        <?= Html::a(Yii::t('app', 'Answers'), ['request-answer/index', 'request_id' => $model->id], ['class' => 'btn btn-info']) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            [
                'label' => 'Priority',
                'value' => Request::PRIORITIES[$model->priority]
            ],
            [
                'label' => 'Category Name',
                'value' => $model->category->name
            ],
             [
                'label' => 'Username',
                'value' => $model->user->username
            ],
            [
                'label' => 'Email',
                'value' => $model->user->email
            ],
            'created_at',
            'answered_at',
            'updated_at',
        ],
    ]) ?>

</div>
