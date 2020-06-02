<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\shop\Category;
use app\models\shop\Image;

/* @var $this yii\web\View */
/* @var $model app\models\shop\shop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'collection')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new')->checkbox() ?>

    <?= $form->field($model, 'sale')->checkbox() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'salePercent')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(Category::find()->select(['name_en', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'activite')->radioList([
        1 => 'Active',
        0 => 'Not active',
    ]) ?>

    <?= $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
