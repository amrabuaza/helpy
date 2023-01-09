<?php

use common\models\Request;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $request Request */
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RequestAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$requestTitle = $request->title;
$this->title = Yii::t('app', "Request Answers for request: ($requestTitle)");
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $requestTitle), 'url' =>  ['request/view', 'id' => $request->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Add Answer'), ['request-answer/create', 'request_id' => $request->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'content',
            'answeredUsername',
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action == "view") {
                        return Url::to(['request-answer/view', 'id' => $key, 'request_id' => $model->request_id]);
                    }
                    if ($action == "update") {
                        return Url::to(['request-answer/update', 'id' => $key, 'request_id' => $model->request_id]);
                    }
                    if ($action == "delete") {
                        return Url::to(['request-answer/delete', 'id' => $key, 'request_id' => $model->request_id]);
                    }
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
