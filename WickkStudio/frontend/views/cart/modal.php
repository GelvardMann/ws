<?php
/* @var $this yii\web\View */
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
$getLang = mb_strtolower('_' . Yii::$app->language);
?>
<?php if (!empty($_SESSION['cart'])) { ?>
    <div class="table-responsive modal-padding">
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

            <?php foreach ($_SESSION['cart'] as $item): ?>
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
                    <td><a href="<?= \yii\helpers\Url::to('/cart/del/' . $item['id']) ?>" class="del-icon">&#10006;</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="text-center">
                <td colspan="2">TOTAL:</td>
                <td><?= $_SESSION['cart.quality'] ?></td>
                <td><?= $_SESSION['cart.sum'] ?></td>
                <td colspan="1"></td>
            </tr>
            </tbody>
        </table>
        <div class="cart-btn-container">
            <button class="p-btn clear-cart-btn" onclick="clearCart()"><?= Yii::t('app', 'Clear') ?></button>
            <a href="/cart" class="p-btn pb-btn"><?= Yii::t('app', 'Order') ?></a>
        </div>
    </div>
<?php } else { ?>
    <h1>Cart is empty</h1>
<?php } ?>
