<?php

use common\models\Category;
use common\models\Request;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Request */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app','request.create')
?>

<div class="sub-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'description')->textarea()?>

    <?=$form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        'language' => 'en-US',
        'options' => ['placeholder' => Yii::t('app','select_category_name')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(Yii::t('app', 'category.name'));
    ?>

    <?=$form->field($model, 'priority')->dropDownList(Request::priorities(), ['prompt' => ''])?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('app', 'send_request'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
