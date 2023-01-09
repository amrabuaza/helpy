<?php

use buttflattery\formwizard\FormWizard;
use common\models\translation\ArticleLanguage;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $modelAr ArticleLanguage */

$this->title = Yii::t('app', 'Create Article');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$steps = [
    [
        'model' => $model,
        'title' => "Article",
        'description' => false,
        'formInfoText' => false,
        'fieldConfig' => [
            "slug" => false,
            "created_at" => false,
            "updated_at" => false,
            'status' => false,
        ]
    ], [
        'model' => $modelAr,
        'title' => "Article Arabic",
        'description' => false,
        'formInfoText' => false,
        'fieldConfig' => [
            "article_id" => false,
            "language" => false,
            "created_at" => false,
            "updated_at" => false,
        ]
    ],
];
?>
<div class="sub-category-create">

    <h1><?=Html::encode($this->title)?></h1>

    <?=FormWizard::widget([
        'steps' => $steps,
        'theme' => FormWizard::THEME_ARROWS,
    ]);?>

</div>
