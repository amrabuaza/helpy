<?php

use common\models\Request;
use yii\web\View;

/** @var View $this */
/** @var Request $model */
/** @var $answers */
?>

<div id="<?= $model->id ?>">
    <div class="request-title-block">
        <label class="request-title"><?= $model->title ?></label>
    </div>
    <div class="request-body">
        <div class="request-header col-lg-12 p-0">
            <div class="answered-at d-flex request-header-item">
                <label class="request-header-label"><?= Yii::t('app', 'answered_at') ?>: </label>
                <span class="request-header-value"><?= $model->answered_at ?></span>
            </div>
            <div class="answered-at d-flex request-header-item">
                <label class="request-header-label"><?= Yii::t('app', 'created_at') ?>: </label>
                <span class="request-header-value"><?= $model->getCreatedSince() ?></span>
            </div>
        </div>
        <div class="request-content col-lg-12">
            <div class="answered-at d-flex request-header-item">
                <label class="request-header-label"><?= Yii::t('app', 'priority') ?>: </label>
                <span class="request-header-value"><?= Request::priorities()[$model->priority] ?></span>
            </div>
            <div class="answered-at d-flex request-header-item">
                <label class="request-header-label"><?= Yii::t('app', 'category') ?>: </label>
                <span class="request-header-value"><?= $model->category->name ?></span>
            </div>
            <hr class="speartor"/>
            <div class="answered-at d-flex request-header-item">
                <label class="request-header-label"><?= Yii::t('app', 'description') ?>: </label>
                <span class="request-header-value"><?= $model->category->description ?></span>
            </div>
        </div>
        <?php if (count($answers)) { ?>
        <div class="answers col-lg-12">
            <p class="answers-link">
                <a class="btn btn-primary" data-toggle="collapse" href="#request-answers-<?= $model->id ?>"
                   role="button" aria-expanded="false" aria-controls="collapseExample">
                    <?= Yii::t('app', 'Answers') ?>
                </a>
            </p>
            <div class="collapse" id="request-answers-<?= $model->id ?>">
                <?php foreach ($answers as $answer) { ?>
                    <div class="answer-item">
                        <div class="answer-item-content">
                            <label class="request-header-label"><?= Yii::t('app', 'answered_at') ?>: </label>
                            <span class="request-header-value"><?= $answer->getCreatedSince() ?></span>
                        </div>
                        <div class="answers-item-content">
                            <?= $answer->content ?>
                        </div>
                    </div>
                    <hr class="speartor"/>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
