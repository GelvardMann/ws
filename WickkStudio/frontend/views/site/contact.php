<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = mb_strtoupper($this->title);
?>
<!-- Start Contact Area -->
<div class="contact-form">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <form id="contact" method="post" action="email.php" data-toggle="validator">
                    <div class="row">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['class' => 'form-control']) ?>

                        <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>

                        <?= $form->field($model, 'subject')->textInput(
                            [
                                'class' => 'form-control',
                                'rows' => '3'
                            ]) ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'cont-send-btn', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div><!-- .row -->
                </form>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- End Contact Area -->
<!-- Start Contact Address -->
<div class="contact-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="cont-data">
                    <div class="cont-icon">
                        <span class="icon-basic_map"></span>
                    </div>
                    <p>Overseas Passenger</p>
                    <p>The Rocks, Sydney 2000</p>
                </div><!-- .cont-data -->
            </div><!-- .col -->
            <div class="col-sm-4">
                <div class="cont-data">
                    <div class="cont-icon">
                        <span class="icon-mobile"></span>
                    </div>
                    <p>Any time. We are open 24/7</p>
                    <p>+1 2345-67-89000</p>
                </div><!-- .cont-data -->
            </div><!-- .col -->
            <div class="col-sm-4">
                <div class="cont-data">
                    <div class="cont-icon">
                        <span class="icon-basic_mail_open"></span>
                    </div>
                    <p>Best support via email</p>
                    <a href="">NextTheme@gmail.com</a>
                </div><!-- .cont-data -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- End Contact Address -->
