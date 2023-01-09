<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Helpy';
?>
<div class="site-index">
    <div class="row-inline end">
        <?= Html::a(Yii::t('app','request.create'), ['request/create'], ['class' => 'btn btn-info']);?>
    </div>
</div>
