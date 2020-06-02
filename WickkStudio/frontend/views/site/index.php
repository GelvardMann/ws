<?php

/* @var $this yii\web\View */
/* @var $products */
/* @var $posts */

/* @var $salePrice */

use yii\helpers\Html;
$getLang = mb_strtolower('_' . Yii::$app->language);

$this->title = 'WickkStudio';

?>

<!-- Start Portfolio Area -->
<section class="portfolio-area">
    <div class="container">
        <div class="portfolio-filter text-center">
            <ul>
                <li class="active"><a href="#" data-filter="*"><?= Yii::t('app', 'All') ?></a></li>
                <li><a href="#" data-filter=".item-1"><?= Yii::t('app', 'New') ?></a></li>
                <li><a href="#" data-filter=".item-2"><?= Yii::t('app', 'Sale') ?></a></li>
            </ul>
        </div><!-- .portfolio-filter-area -->
        <div class="portfolio" id="portfolio_box">
            <?php foreach ($products as $product) { ?>
                <div class="portfolio-item
                <?php if ($product['new'] == true) {
                    echo 'item-1';
                }
                if ($product['sale'] == true) {
                    echo 'item-2';
                } ?>
                ">
                    <div class="inner-portfolio">
                        <?php if ($product['new'] == true) { ?>
                            <div class="label"><h4><?= Yii::t('app', 'New') ?></h4></div>
                        <?php } ?>
                        <?php if ($product['sale'] == true) { ?>
                            <div class="label"><h4><?= Yii::t('app', 'Sale') ?></h4></div>
                        <?php } ?>
                        <?php if (!empty($product['images'])) { ?>
                            <a href="<?= \yii\helpers\Url::to('/shop/view/' . $product['id']) ?>">
                                <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/images/'
                                    . $product['id'] . '/'
                                    . $product['images'][0]
                                ), ['class' => 'image-max-size']);
                                ?>
                            </a>
                        <?php } else { ?>
                            <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/images/noImage.jpg')) ?>
                        <?php } ?>
                    </div><!-- .inner-portfolio -->
                    <div class="price-container">
                        <h4>
                            <?= Html::a($product['product_name'.$getLang], \yii\helpers\Url::to('shop/view/' . $product['id'])) ?>
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
                    </div> <!-- .price-container -->
                </div> <!-- .portfolio-item -->
            <?php } ?>
        </div><!-- .portfolio -->
        <?= Html::a(Yii::t('app', 'Shop'), \yii\helpers\Url::to('/shop'), ['class' => 'pb-btn index-custom-button-center']) ?>
    </div><!-- .container -->
</section>
<!-- End Portfolio Area -->
<section class="hero-area" id="parallax-bg">
    <div class="container">
        <div class="hero-title text-center">
            <h2 class="text-uppercase"><?= Yii::t('app', 'About us') ?></h2>
            <h4><?= Yii::t('app', 'WE HAVE MANY THINGS TO SAY') ?></h4>
            <?= Html::a(Yii::t('app', 'More'), \yii\helpers\Url::to('/about'), ['class' => 'pb-btn p-btn-medium index-custom-button']) ?>
        </div><!-- .hero-title -->
    </div><!-- .container -->
</section>

<!-- Start Blog Group -->
<section class="blog-group">
    <div class="container">
        <div class="section-header text-center">
            <h2>
                <?= Html::a(Yii::t('app', 'Our blog'), \yii\helpers\Url::to('/blog')) ?>
            </h2>
            <h3><?= Yii::t('app', 'WE HAVE MANY THINGS TO SAY') ?></h3>
        </div><!-- .section-header -->
        <div class="row">
            <?php
            $titleLang = 'title' . $getLang;
            $contentLang = 'content' . $getLang;
            ?>
            <?php foreach ($posts as $post) { ?>
                <div class="col-sm-4">
                    <div class="single-post">
                        <div class="post-img">
                            <a href="<?= \yii\helpers\Url::to(['blog/view/' . $post->id]) ?>">
                                <?php if (!empty($post->image)) { ?>
                                    <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/blog' . '/'
                                        . $post->id . '/'
                                        . $post->image),
                                        [
                                            'alt' => $post->$titleLang,
                                            'class' => 'img-responsive'
                                        ]) ?>
                                <?php } else { ?>
                                    <?= \yii\helpers\Html::img(\yii\helpers\Url::to('uploads/images/noImage.jpg'),
                                        [
                                            'alt' => 'Image not found',
                                            'class' => 'img-responsive'
                                        ]) ?>
                                <?php } ?>
                            </a>
                            <div class="post-date text-center">
                                <span><?= Yii::$app->formatter->asDate($post->date, 'php:d, M'); ?></span>
                                <span><?= Yii::$app->formatter->asDate($post->date, 'yyyy'); ?></span>
                            </div>
                        </div><!-- End "post-img" -->
                        <div class="post-desk">
                            <h3 class="text-uppercase">
                                <a href="<?= \yii\helpers\Url::to('blog/view/' . $post->id) ?>">
                                    <?= $post->$titleLang ?>
                                </a>
                            </h3>
                            <p><?= substr($post->$contentLang, 0, 100) ?>...</p>
                            <?= Html::a(Yii::t('app', 'Read more'), \yii\helpers\Url::to('/blog/view/' . $post->id), ['class' => 'pb-btn p-btn-medium']) ?>
                        </div><!-- End "post-desk" -->
                    </div><!-- End "single-post" -->
                </div><!-- End col -->
            <?php } ?>
            <?= Html::a(Yii::t('app', 'Blog'), \yii\helpers\Url::to('/blog'), ['class' => 'pb-btn index-custom-button-center']) ?>
        </div><!-- End "row" -->
    </div><!-- End "container" -->
</section>
<!-- End Blog Group -->