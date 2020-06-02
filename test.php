<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => '/',
    'options' => [
        'class' => 'navbar navbar-default navbar-fixed-top',
        'id' => 'custom-bootstrap-menu'

    ],


]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/']],
    ['label' => 'About', 'url' => ['/about']],
    ['label' => 'Contact', 'url' => ['/contact']],
    ['label' => '', 'url' => ['/contact']],
];
$menuItems[] =
    [
        'label' => '',
        'url' => '/contact',
        'options' =>
            [
                'class' => 'glyphicon glyphicon-shopping-cart navbar-link'
            ]
    ];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'encodeLabels' => false,
    'items' => $menuItems,
]);
NavBar::end();
?>


echo "
<pre>";
print_r($products['images']);
echo "</pre>";
exit;


function r(e) {
A || t();
var o = e.target, r = u(o);
if (!r || e.defaultPrevented || e.ctrlKey) return !0;
if (w(D, "embed") || w(o, "embed") && /\.pdf/i.test(o.src) || w(D, "object")) return !0;
var a = -e.wheelDeltaX || e.deltaX || 0, i = -e.wheelDeltaY || e.deltaY || 0;
return K && (e.wheelDeltaX && b(e.wheelDeltaX, 120) && (a = -120 * (e.wheelDeltaX / Math.abs(e.wheelDeltaX))), e.wheelDeltaY && b(e.wheelDeltaY, 120) && (i = -120 * (e.wheelDeltaY / Math.abs(e.wheelDeltaY)))), a || i || (i = -e.wheelDelta || 0), 1 === e.deltaMode && (a *= 40, i *= 40), !z.touchpadSupport && v(i) ? !0 : (Math.abs(a) > 1.2 && (a *= z.stepSize / 120), Math.abs(i) > 1.2 && (i *= z.stepSize / 120), n(r, a, i), e.preventDefault(), void l())
}


public function getAllProducts()
{
$query = new Query();
$query->select('*')
->from('shop')
->innerJoin('image', '`shop`.`id` = `image`.`itemId`');
$command = $query->createCommand();
$products = $command->queryAll();

foreach ($products as $product) {
$id = $product['itemId'];
foreach ($products as $key => $value) {
if ($value['itemId'] == $id) {
$resultPic[$id]['image' . $key] = $value['name'];
$result[$id] = $value;
}
}

}

foreach ($result as $product) {
$result[$product['itemId']]['images'] = array_values($resultPic[$product['itemId']]);
}
return $result;

}

public function getNewSaleProducts()
{
$query = new Query();
$query->select('*')
->from('shop')
->where([
'new' => true,
'activite' => true
])
->orWhere([
'sale' => true,
'activite' => true])
->innerJoin('image', '`shop`.`id` = `image`.`itemId`');
$command = $query->createCommand();
$products = $command->queryAll();
foreach ($products as $product) {
$id = $product['itemId'];
foreach ($products as $key => $value) {
if ($value['itemId'] == $id) {
$resultPic[$id]['image' . $key] = $value['name'];
$result[$id] = $value;
}
}

}

foreach ($result as $product) {
$result[$product['itemId']]['images'] = array_values($resultPic[$product['itemId']]);
}
return $result;

}


<?php
/* @var $this yii\web\View */
/* @var $products */
/* @var $salePrice */
/* @var $category */
?>

<!-- Start Portfolio Single -->
<section class="prtfolio-s-area">
    <div class="container">
        <div class="slider_box">
            <div class="tabs owl-carousel slider_box_item">
                <?php foreach ($data

                as $product) { ?>
                <?php if (!empty($product['images'])) { ?>
                <?php foreach ($product['images'] as $image) { ?>
                    <div class="">
                        <?= \yii\helpers\Html::img('/uploads/images/' . $product['itemId'] . '/' . $image) ?>
                    </div>
                <?php } ?>
            </div>
            <?php } else { ?>
                <?= \yii\helpers\Html::img('/uploads/images/noImage.jpg') ?>
            <?php } ?>
            <div class="slider_box_item">
                <ul class="slider_nav slider_box_item">
                    <?php if (!empty($product['images'])) { ?>
                        <?php foreach ($product['images'] as $image) { ?>
                            <li class="thumb">
                                <?= \yii\helpers\Html::img('/uploads/images/' . $product['itemId'] . '/' . $image) ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="portfolio-s-head">
                    <h2>TITLE OF THIS POST</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                        nascetur ridiculus mus.</p>
                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat
                        massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                        enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.Nullam dictum felis eu pede
                        mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean
                        vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                        ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
                </div>
            </div><!-- .col -->
            <div class="col-sm-3">
                <div class="portfolio-info-box">
                    <ul class="portfolio-s-info">
                        <li><span>CATEGORY:</span>HTML, WordPress</li>
                        <li><span>CLIENT:</span> NextTheme</li>
                        <li><span>CREATED BY:</span> John Doe</li>
                        <li><span>DATE:</span> 10 Jan, 2015</li>
                    </ul>
                    <a href="#" class="pb-btn p-btn-small">View Demo</a>
                </div>
            </div>
        </div>
        <div class="social-feedback text-center">
            <span>SHARE THIS POST </span>
            <a href="#" class="common-btn">Facebook</a>
            <a href="#" class="common-btn">Twitter</a>
            <a href="#" class="common-btn">Instagram</a>
            <a href="#" class="common-btn">Pinterest</a>
        </div><!-- .social-feedback -->
        <div class="p-pagination">
            <a href="#" class="p-next"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <a href="#" class="p-active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#" class="p-prev"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        </div><!-- .t-pagination -->
    </div>
</section>


<?php

/* @var $this yii\web\View */
/* @var $products */
/* @var $posts */

/* @var $salePrice */

use yii\helpers\Html;

$this->title = 'WickkStudio';

?>

<!-- Start Portfolio Area -->
<section class="portfolio-area">
    <div class="container">
        <div class="portfolio-filter text-center">
            <ul>
                <li class="active"><a href="#" data-filter="*">ALL</a></li>
                <li><a href="#" data-filter=".item-1">News</a></li>
                <li><a href="#" data-filter=".item-2">Sale</a></li>
            </ul>
        </div><!-- .portfolio-filter-area -->
        <div class="portfolio" id="portfolio_box">
            <?php foreach ($products

                           as $product) { ?>
        <?php if ($product['new'] == true) { ?>
            <div class="portfolio-item item-1">
                <?php } ?>
                <?php if ($product['sale'] == true) { ?>
                <div class="portfolio-item item-2">
                    <?php } ?>
                    <div class="inner-portfolio">
                        <?php if ($product['new'] == true) { ?>
                            <div class="label"><h4>NEW</h4></div>
                        <?php } ?>
                        <?php if ($product['sale'] == true) { ?>
                            <div class="label"><h4>SALE</h4></div>
                        <?php } ?>
                        <?php if (!empty($product['images'])) { ?>
                            <a href="<?= \yii\helpers\Url::to(['/shop/view/' . $product['id']]) ?>">
                                <?= \yii\helpers\Html::img(\yii\helpers\Url::to(['uploads/images/'
                                    . $product['id'] . '/'
                                    . $product['images'][0]
                                ]));
                                ?>
                            </a>
                        <?php } else { ?>
                            <?= \yii\helpers\Html::img(\yii\helpers\Url::to('uploads/images/noImage.jpg')) ?>
                        <?php } ?>
                    </div><!-- .inner-portfolio -->
                    <div class="price-container">
                        <h4>
                            <?= Html::a($product['product_name'], \yii\helpers\Url::to(['shop/view/' . $product['id']])) ?>
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
            <?= Html::a('shop', [\yii\helpers\Url::to(['/shop'])], ['class' => 'pb-btn index-custom-button-center']) ?>
        </div><!-- .container -->
</section>
<!-- End Portfolio Area -->
<section class="hero-area" id="parallax-bg">
    <div class="container">
        <div class="hero-title text-center">
            <h1>About us</h1>
            <h4>We Have Many Things To Say</h4>
            <?= Html::a('More', [\yii\helpers\Url::to(['/about'])], ['class' => 'pb-btn p-btn-medium index-custom-button']) ?>
        </div><!-- .hero-title -->
    </div><!-- .container -->
</section>

<!-- Start Blog Group -->
<section class="blog-group">
    <div class="container">
        <div class="section-header text-center">

            <h2>
                <?= Html::a('Our Blog', \yii\helpers\Url::to(['/blog'])) ?>
            </h2>
            <h3>We Have Many Things To Say</h3>
        </div><!-- .section-header -->
        <div class="row">
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
                                            'alt' => $post->title,
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
                                    <?= $post->title ?>
                                </a>
                            </h3>
                            <p><?= substr($post->content, 0, 100) ?>...</p>
                            <?= Html::a('Read more', [\yii\helpers\Url::to(['/blog/view/' . $post->id])], ['class' => 'pb-btn p-btn-medium']) ?>
                        </div><!-- End "post-desk" -->
                    </div><!-- End "single-post" -->
                </div><!-- End col -->
            <?php } ?>
            <?= Html::a('blog', [\yii\helpers\Url::to(['/blog'])], ['class' => 'pb-btn index-custom-button-center']) ?>
        </div><!-- End "row" -->
    </div><!-- End "container" -->
</section>
<!-- End Blog Group -->


