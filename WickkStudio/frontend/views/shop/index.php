<?php
/* @var $this yii\web\View */
/* @var $products */
/* @var $salePrice */
/* @var $category */

/* @var $nameCategory */

use yii\helpers\Url;
use yii\widgets\LinkPager;
$getLang = mb_strtolower('_' . Yii::$app->language);

if (!empty($nameCategory)) {
    $this->params['breadcrumbs'][] =
        [
            'label' => Yii::t('app', 'Shop'),
            'url' => '/shop'
        ];
    $this->params['breadcrumbs'][] = $nameCategory;
} else {
    $this->params['breadcrumbs'][] = Yii::t('app', 'Shop');
}
?>

<!-- Start Portfolio Area -->
<section class="portfolio-area">
    <div class="container">
        <div class="text-center">
            <ul class="category-list-horizontal">
                <?php if (empty($nameCategory)) { ?>
                    <li class="active">
                        All
                    </li>
                <?php } else { ?>
                    <li>
                        <?= \yii\helpers\Html::a(Yii::t('app', 'All'), Url::to('/shop')) ?>
                    </li>
                <?php } ?>
                <?php foreach ($category as $item) {
                    $name = 'name' . $getLang;
                    ?>
                    <?php if (!empty($nameCategory) && $nameCategory == mb_strtolower($item->$name)) { ?>

                        <li class="active">
                            <?= $item->$name ?>
                        </li>
                    <?php } else { ?>
                        <li>
                            <?= \yii\helpers\Html::a($item->$name, Url::to('/shop/' . mb_strtolower($item->name_en))) ?>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div><!-- .portfolio-filter-area -->

        <div class="portfolio">
            <?php foreach ($products['items'] as $product) { ?>
                <div class="portfolio-item item-<?= $product['category_id'] ?>">
                    <div class="inner-portfolio">
                        <?php if ($product['new'] == true) { ?>
                            <div class="label"><h4><?= Yii::t('app', 'New') ?></h4></div>
                        <?php } ?>
                        <?php if ($product['sale'] == true) { ?>
                            <div class="label"><h4><?= Yii::t('app', 'Sale') ?></h4></div>
                        <?php } ?>
                        <?php if (!empty($product['images'])) { ?>
                        <a href="<?= Url::to('/shop/view/' . $product['id']) ?>">
                            <?= \yii\helpers\Html::img(Url::to(
                                '/uploads/images/'
                                . $product['id'] . '/'
                                . $product['images'][0]),
                                [
                                    'alt' => $product['product_name' . $getLang],
                                    'class' =>
                                        [
                                            'media-object',
                                            'image-max-size'
                                        ]
                                ]) ?>
                            <?php } else { ?>
                                <?= \yii\helpers\Html::img(Url::to('/uploads/images/noImage.jpg'),
                                    [
                                        'alt' => 'Image not found',
                                        'class' => 'media-object'
                                    ]) ?>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="price-container">
                        <h4>
                            <?= \yii\helpers\Html::a($product['product_name' . $getLang], Url::to('shop/view/' . $product['id'])) ?>
                        </h4>
                        <?php if ($product['sale'] == true) {
                            $salePrice = $product['price'] / 100 * $product['salePercent'];
                            $salePrice = $product['price'] - $salePrice; ?>
                            <div class="sale-price-container">
                                <h5 class="old-price">$ <?= $product['price'] ?>&nbsp;</h5>
                                <h4>$ <?= $salePrice ?></h4>
                            </div>
                        <?php } else { ?>
                            <h4><?= $product['price'] ?> $</h4>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div><!-- .portfolio -->
        <?= LinkPager::widget([
            'pagination' => $products['pages'],
            'hideOnSinglePage' => true,
            'prevPageLabel' => '&larr;',
            'nextPageLabel' => '&rarr;',
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'LAST',
            'maxButtonCount' => 3,
            'activePageCssClass' => 'p-active',
            // Настройки контейнера пагинации
            'options' => [
                'tag' => 'ul',
                'class' => 'p-pagination',
            ],

            // Настройки классов css для ссылок

            'disabledPageCssClass' => 'p-not-active',
            // Настройки для навигационных ссылок
            'prevPageCssClass' => 'p-prev',
            'nextPageCssClass' => 'p-next',


        ]); ?>
    </div><!-- .container -->
</section>