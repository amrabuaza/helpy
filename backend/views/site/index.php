<?php

/* @var $this yii\web\View */
/* @var $requestCount int */
/* @var $articleCount int */
/* @var $answerCount int */
/* @var $pendingRequestCount int */

use yii\helpers\Html;

$this->title = 'Helpy Dashboard';
?>
<div class="site-index">
    <div class="flex wrap mb24">
        <div class="reporting-small-box">
            <div class="rep-box">
                <div class="rep-box-body full-width">
                    <div class="center-items">
                        <h3 class="text-dark reporting-box-numbers">
                            <span class="reporting-icon fa fa-ticket"></span>
                            <?= $requestCount ?>
                        </h3>
                        <h4 class="text-mute pointer">
                            <?= Html::a(Yii::t('app', 'Total Requests'), ['request/index']) ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="reporting-small-box">
            <div class="rep-box">
                <div class="rep-box-body full-width">
                    <div class="center-items">
                        <h3 class="text-dark reporting-box-numbers">
                            <span class="reporting-icon fa fa-ticket"></span>
                            <?= $pendingRequestCount ?>
                        </h3>
                        <h4 class="text-mute pointer">
                            <?= Html::a(Yii::t('app', 'Pending Requests'), ['request/index', 'status' => 'pending']) ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="reporting-small-box">
            <div class="rep-box">
                <div class="rep-box-body full-width">
                    <div class="center-items">
                        <h3 class="text-dark reporting-box-numbers">
                            <span class="reporting-icon fa fa-question"></span>
                            <?= $answerCount ?>
                        </h3>
                        <h4 class="text-mute pointer">Total Answers</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="reporting-small-box">
            <div class="rep-box">
                <div class="rep-box-body full-width">
                    <div class="center-items">
                        <h3 class="text-dark reporting-box-numbers">
                            <span class="reporting-icon fa fa-list-alt"></span>
                            <?= $articleCount ?>
                        </h3>
                        <h4 class="text-mute pointer">
                            <?= Html::a(Yii::t('app', 'Total Articles'), ['article/index']) ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
