<?php

/* @var $this yii\web\View */
/* @var $dataProvider */

use frontend\widgets\RequestItemWidget\RequestItemWidget;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app','my_requests');
?>
<section class="mt-3">
    <div class="row-inline end">
        <?= Html::a(Yii::t('app','request.create'), ['request/create'], ['class' => 'btn btn-info']);?>
    </div>
    <?=
    ListView::widget([
        'dataProvider'          => $dataProvider,
        'layout'                => "{items}\n{pager}",
        'emptyText'             => '',
        'options'               => ['class' => 'list-view d-flex flex-wrap request-listing'],
        'itemOptions'           => ['class' => 'item request-item col-lg-5 col-12 p-lg-2 p-0'],
        'itemView'              => function ($model, $key, $index, $widget) {
            return RequestItemWidget::widget([
                'model' => $model,
            ]);
        },
    ]);
    ?>
</section>
