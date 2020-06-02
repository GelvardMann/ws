<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>


<?php $this->beginPage() ?>
    <!doctype html>
    <html class="no-js" lang="en">
    <head>
        <!-- Meta Tags -->
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="NextTheme">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <!-- Page Title -->
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- Start Preloader -->
    <div id="p-preloader">
        <div class="p-preloader-wave"></div>
    </div>
    <!-- End Preloader -->
    <!-- Start Header -->
    <header class="header-wrap">
        <div class="navbar-collapse">
            <div class="navbar-container">
                <div class="container position-rl">
                    <div class="nav-bar-area">
                        <div class="menu-toggle">
                            <div class="menu-bar"><span></span></div>
                            <div class="menu-text">MENU</div>
                        </div>
                    </div><!-- .nav-bar-area -->
                    <div class="pull-left">
                        <a href="/cart" class="cart">
                            <?php if (empty($_SESSION['cart'])) { ?>
                                <?= Html::img(\yii\helpers\Url::to('/img/cart.png')) ?>
                            <?php } else { ?>
                                <?= Html::img(\yii\helpers\Url::to('/img/cart_full.png')) ?>
                            <?php } ?>
                        </a>
                        <a href="/" class="logo">
                            <h4 class="text-uppercase">Wickk Studio</h4>
                            <!-- For img Logo -->
                            <!-- <img src="img/logo.png" alt=""> -->
                        </a><!-- .logo -->
                    </div><!-- .pull-left -->
                </div><!-- .container -->
            </div><!-- .navbar-container -->
        </div><!-- .navbar-collapse -->
        <div class="nav-area">
            <div class="inner-nav-area">
                <nav class="nav-list">
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => 'Home', 'url' => ['/']],
                            ['label' => 'Shop', 'url' => ['/shop']],
                            ['label' => 'Brand', 'url' => ['/brand']],
                            ['label' => 'Blog', 'url' => ['/blog']],
                            ['label' => 'About', 'url' => ['/about']],
                            ['label' => 'Contacts', 'url' => ['/contact']],

                        ],
                        'activeCssClass' => 'active-menu',
                    ]); ?>
                </nav><!-- .nav-list -->

            </div><!-- .inner-nav-area -->
            <div class="container nav-other">
                <p class="menu-copyright pull-left">&copy; Copyright 2017 NextTheme. All Rights Reserved.</p>
                <div class="menu-socials pull-right">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div><!-- .nav-area -->
    </header>
    <!-- End Header -->

    <div class="wrapper">
        <?= $content ?>
    </div>

    <!-- Start Footer -->
    <footer class="footer-area text-center">
        <div class="container">
            <div class="footer-social-area wow animated slideInUp">
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Pinterest</a></li>
                </ul>
            </div><!-- .footer-social-area -->
            <div class="copyright wow animated slideInUp">
                <p>&copy; Copyright 2017 NextTheme. All Rights Reserved.</p>
            </div><!-- .copyright -->
            <a href="#" id="scroll-to-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        </div><!-- .container -->
    </footer>
    <?php
    \yii\bootstrap\Modal::begin(
        [
            'id' => 'modalCart',
            'size' => 'modal-lg',
            'header' => '<h2>Cart</h2>',
            'footer' => ''
        ]);
    \yii\bootstrap\Modal::end();
    ?>
    <!-- End Footer -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>