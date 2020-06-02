<?php


/* @var $this yii\web\View */
/* @var $products */
/* @var $salePrice */
/* @var $category */

/* @var $categoryId */

use yii\helpers\Html;
use app\models\shop\Category;

$getLang = mb_strtolower('_' . Yii::$app->language);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Shop'),
    'url' => '/shop'
];
$this->title = $products[array_key_first($products)]['product_name' . $getLang];
foreach ($products as $product) {
    $categoryId = $product['category_id'];
}
$categoryName = Category::findOne(['id' => $categoryId]);
$categoryNamePref = 'name_' . Yii::$app->language;
$this->params['breadcrumbs'][] =
    [
        'label' => $categoryName->$categoryNamePref,
        'url' => '/shop/' . mb_strtolower($categoryName->name_en),
    ];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="blog-area">
    <div class="container">
        <h1 class="title-page"><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-sm-6">
                <?php foreach ($products

                as $product) { ?>
                <div class="blog-item single-blog-item">
                    <div class="blog-media">
                        <div id="blog-slider">
                            <?php if (!empty($product['images'])) { ?>
                                <?php foreach ($product['images'] as $image) { ?>
                                    <div>
                                        <?= \yii\helpers\Html::img('/uploads/images/' . $product['id'] . '/' . $image) ?>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <?= \yii\helpers\Html::img('/uploads/images/noImage.jpg') ?>
                            <?php } ?>
                        </div><!-- End "about-slider" -->
                    </div><!-- .blog-media -->
                    <div class="blog-item-body">
                        <div class="blog-item-data"><?= $product['collection'] ?></div>
                    </div><!-- .blog-item-body -->
                </div><!-- .blog-post -->
            </div><!-- .col -->
            <div class="col-sm-6">
                <div class="cart-btn-container">
                    <div class="count-container">
                        <button class="minus">-</button>
                        <input id="count" type="text" value="1" size="3"/>
                        <button class="plus">+</button>
                    </div>
                    <?= Html::button(Yii::t('app', 'Buy'),
                        [
                            'class' => 'pb-btn p-btn-large add-to-cart',
                            'data-id' => $product['id'],
                        ]) ?>
                </div>
                <p class="indent-top-bottom"><?= $product['description' . $getLang] ?></p>
            </div>
        </div><!-- .row -->
        <?php } ?>
    </div><!-- .container -->
</section>