<?php


/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\widgets\SwitchLang\DropDownLanguageItem;

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
                            <?php
                            $languageItem = new DropDownLanguageItem([
                                'languages' => [
                                    'en' => '<span class="flag-icon flag-icon-us test"></span>En',
                                    'ru' => '<span class="flag-icon flag-icon-ru"></span>Ru',
                                ],
                                'options' =>
                                    [
                                        'encode' => false,
                                    ],
                            ]);
                            $languageItem = $languageItem->toArray();
                            $languageDropdownItems = \yii\helpers\ArrayHelper::remove($languageItem, 'items');
                            echo \yii\bootstrap\ButtonDropdown::widget([
                                'label' => $languageItem['label'],
                                'encodeLabel' => false,
                                'options' =>
                                    [
                                        'class' => 'btn-lang',
                                    ],
                                'containerOptions' =>
                                    [
                                            'class' => 'change-lang'
                                    ],
                                'dropdown' => [
                                    'items' => $languageDropdownItems
                                ]
                            ]);
                            ?>
                        <a href="/cart" class="cart">
                            <?php if (empty($_SESSION['cart'])) { ?>
                                <?= Html::img(\yii\helpers\Url::to('/img/cart.png')) ?>
                            <?php } else { ?>
                                <?= Html::img(\yii\helpers\Url::to('/img/cart_full.png')) ?>
                            <?php } ?>
                        </a>
                        <a href="/" class="logo">
                            <h4 class="text-uppercase">Wickk studio</h4>
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
                            ['label' => Yii::t('app', 'Home'), 'url' => ['/']],
                            ['label' => Yii::t('app', 'Shop'), 'url' => ['/shop']],
                            ['label' => Yii::t('app', 'Brand'), 'url' => ['/site/brand']],
                            ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog']],
                            ['label' => Yii::t('app', 'About us'), 'url' => ['/site/about']],
                            ['label' => Yii::t('app', 'Contacts'), 'url' => ['/site/contact']],

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

    <section class="hero-area" id="parallax-bg">
        <div class="container">
            <div class="hero-title text-center">
                <h2 class="text-uppercase">Wickk studio</h2>
                <?=
                Breadcrumbs::widget([
                    'homeLink' => ['label' => Yii::t('app', 'Home'), 'url' => '/'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],

                ])
                ?>
            </div><!-- .hero-title -->
        </div><!-- .container -->
    </section>

    <?= $content ?>

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