<?php
/* @var $this yii\web\View */

/* @var $order */

/* @var $category */

use yii\widgets\ActiveForm;

$getLang = mb_strtolower('_' . Yii::$app->language);

$this->params['breadcrumbs'][] = [
    'label' => mb_strtoupper(Yii::t('app', 'Blog'))

];

?>

<div class="container indent-only-top-bottom">
    <?php if (Yii::$app->session->hasFlash('success')) { ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
            </button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
            </button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php } ?>
    <?php if (!empty($session['cart'])) { ?>
        <section class="sd-section table-section">
            <div class="section-header text-center">
                <h2>Wickk Studio Cart</h2>
            </div><!-- .section-header -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Quality</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($session['cart'] as $item): ?>
                        <tr class="text-center">
                            <td><?= \yii\helpers\Html::img(\yii\helpers\Url::to(
                                    '/uploads/images/'
                                    . $item['id'] . '/'
                                    . $item['image']),
                                    [
                                        'class' => 'image-cart-table'
                                    ]) ?>
                            </td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['quality'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td>
                                <?= \yii\helpers\Html::a('&#10006;',\yii\helpers\Url::to('/cart/del/' . $item['id']),
                                    [
                                        'data-id' => $item['id'],
                                        'class' => 'del-icon',
                                    ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="text-center">
                        <td colspan="2">TOTAL:</td>
                        <td><?= $session['cart.quality'] ?></td>
                        <td><?= $session['cart.sum'] ?></td>
                        <td colspan="1"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart-btn-container">
                <?= \yii\helpers\Html::a(Yii::t('app', 'Clear'), \yii\helpers\Url::to('/cart/clear'), ['class' => 'p-btn margin-left'])?>
            </div>
        </section>
        <section>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($order, 'name') ?>
            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'address') ?>
            <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Order'), ['class' => 'p-btn margin-left']) ?>
            <?php ActiveForm::end(); ?>
        </section>
    <?php } else { ?>
        <h1 class="align-center-test"><?= Yii::t('app', 'Cart is empty') ?></h1>
    <?php } ?>
</div>