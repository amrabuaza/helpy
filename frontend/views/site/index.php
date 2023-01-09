<?php

/* @var $this yii\web\View */

/* @var $articles */

use common\models\Article;
use yii\helpers\Html;

$this->title = 'Helpy';
?>
<div class="site-index">

    <div class="row-inline end">
        <?= Html::a(Yii::t('app', 'request.create'), ['request/create'], ['class' => 'btn btn-info']); ?>
    </div>

    <div class="d-flex">
        <div class="col-lg-6">
            <div class="articles">
                <?php
                /** @var Article $article */
                foreach ($articles as $article) { ?>
                    <div class="article-item">
                        <div class="article-title">
                            <?= $article->title ?>
                        </div>
                        <div class="article-content">
                            <?= $article->description ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="home-page-image"></div>
        </div>
    </div>
</div>
