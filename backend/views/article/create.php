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
            "title_ar" => false,
            "description_ar" => false,
            'status' => false,
            'description' => [
                'widget' => alexantr\ckeditor\CKEditor::class,
                'options' => [
                    'clientOptions' => [
                        'extraPlugins' => 'autogrow,colorbutton,colordialog,iframe,justify,showblocks',
                        'removePlugins' => 'resize',
                        'autoGrow_maxHeight' => 900,
                        'stylesSet' => [
                            ['name' => 'Subscript', 'element' => 'sub'],
                            ['name' => 'Superscript', 'element' => 'sup'],
                        ],
                    ]
                ],
            ]
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
            'description' => [
                'widget' => alexantr\ckeditor\CKEditor::class,
                'options' => [
                    'clientOptions' => [
                        'extraPlugins' => 'autogrow,colorbutton,colordialog,iframe,justify,showblocks',
                        'removePlugins' => 'resize',
                        'autoGrow_maxHeight' => 900,
                        'stylesSet' => [
                            ['name' => 'Subscript', 'element' => 'sub'],
                            ['name' => 'Superscript', 'element' => 'sup'],
                        ],
                    ]
                ],
            ]
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
