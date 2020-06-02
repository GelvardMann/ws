<?php
/* @var $this yii\web\View */

/* @var $model backend\models\site\Site */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\site\Site;

?>

<h1>Main Settings</h1>
<div class="table-responsive modal-padding">
    <table class="table" valign="middle">
        <thead>
        <tr>
            <th class="text-center">Object</th>
            <th class="text-center">View</th>
            <th class="text-center">Action</th>
            <th class="text-center">BackUp</th>
        </tr>
        </thead>
        <tbody>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <tr class="text-center">
            <td>Main Image</td>
            <td><?= \yii\helpers\Html::img(Yii::$app
                    ->urlManagerF
                    ->createUrl('/img/mainImage.jpg'),
                    ['style' => [
                        'max-width' => '150px',
                        'margin' => '20px'
                    ]]) ?></td>
            <td>
                <?= $form->field($model, 'mainImage')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
            </td>
            <td>
                <?= Html::a('', \yii\helpers\Url::to(['/main/rollback']),
                    [
                        'class' => 'glyphicon glyphicon-repeat backup-arrow',
                        'aria-hidden' => 'true',
                        'style' => 'font-size: 22px;'
                    ]) ?>
            </td>
        </tr>
        <tr class="text-center">
            <td colspan="4" class="align-vertical"></td>
            <td class="align-vertical">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </td>
        </tr>
        <?php ActiveForm::end(); ?>
        </tbody>
    </table>
</div>
