<?php

use buttflattery\formwizard\FormWizard;
use common\models\Category;
use common\models\translation\CategoryLanguage;
use common\models\user\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Category */

/* @var $this yii\web\View */
/* @var $modelAr CategoryLanguage */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$steps = [
    [
        'model' => $model,
        'title' => "Category",
        'description' => false,
        'formInfoText' => false,
        'fieldConfig' => [
            "created_at" => false,
            "updated_at" => false,
            "name_ar" => false,
            "description_ar" => false,
            'status' => false,
            'user_id' => [
                'widget' => Select2::class,
                'options' => [
                    'data' => ArrayHelper::map(User::find()->andWhere(['user_type' => User::TYPE_ADMIN])->all(), 'id', 'username'),
                ],
            ]
        ]
    ], [
        'model' => $modelAr,
        'title' => "Category Arabic",
        'description' => false,
        'formInfoText' => false,
        'fieldConfig' => [
            "category_id" => false,
            "language" => false,
            "created_at" => false,
            "updated_at" => false,
        ]
    ],
];
?>
<div class="main-category-create">

    <h1><?=Html::encode($this->title)?></h1>

    <?=FormWizard::widget([
        'steps' => $steps,
        'theme' => FormWizard::THEME_ARROWS,
    ]);?>

</div>
