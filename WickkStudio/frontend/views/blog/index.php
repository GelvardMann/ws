<?php
/* @var $this yii\web\View */
/* @var $posts */

/* @var $latestPosts */

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
$getLang = mb_strtolower('_' . Yii::$app->language);
$titleLang = 'title' . $getLang;
$contentLang = 'content' . $getLang;

$this->title = mb_strtoupper(Yii::t('app', 'Blog'));
$this->params['breadcrumbs'][] = mb_strtoupper(Yii::t('app', 'Blog'));
?>

<section class="blog-area">
    <div class="container">
        <h1 class="title-page"><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-sm-8">
                <?php foreach ($posts['posts'] as $post) { ?>
                    <div class="blog-item">
                        <div class="blog-media">
                            <?= \yii\helpers\Html::img(Url::to('/uploads/blog/' . $post->id . '/' . $post->image)) ?>
                        </div><!-- .blog-media -->
                        <div class="blog-item-body">
                            <div class="blog-item-data"><?= Yii::$app->formatter->asDate($post->date, 'php:d, M yy'); ?></div>
                            <h2>
                                <?= \yii\helpers\Html::a($post->$titleLang, Url::to('/blog/view/' . $post->id)) ?>
                            </h2>
                            <p><?= substr($post->$contentLang, 0, 160) ?>...</p>
                            <?= \yii\helpers\Html::a(Yii::t('app', 'Read more'), Url::to('/blog/view/' . $post->id), ['class' => 'pb-btn p-btn-medium']) ?>
                        </div><!-- .blog-item-body -->
                    </div><!-- .blog-post -->
                <?php } ?>

                <?= LinkPager::widget([
                    'pagination' => $posts['pages'],
                    'hideOnSinglePage' => true,
                    'prevPageLabel' => '&larr;',
                    'nextPageLabel' => '&rarr;',
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'LAST',
                    'maxButtonCount' => 2,
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
                <!--                    <a href="#" class="p-next"><i class="fa fa-angle-left" aria-hidden="true"></i></a>-->
                <!--                    <a href="#" class="p-active">1</a>-->
                <!--                    <a href="#">2</a>-->
                <!--                    <a href="#">3</a>-->
                <!--                    <a href="#" class="p-prev"><i class="fa fa-angle-right" aria-hidden="true"></i></a>-->

            </div><!-- .col -->
            <div class="col-sm-4">
                <aside class="sidebar">
                    <div class="widget">
                        <h3 class="widget-title"><?=Yii::t('app', 'Latest posts')?></h3>
                        <div class="widget-body">
                            <?php foreach ($latestPosts as $post) { ?>
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="<?= Url::to('/blog/view/' . $post->id) ?>">
                                            <?php if (!empty($post->image)) { ?>
                                                <?= \yii\helpers\Html::img(Url::to('/uploads/blog/' . $post->id . '/' . $post->image),
                                                    [
                                                        'alt' => $post->$titleLang,
                                                        'class' => 'media-object'
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
                                    <div class="media-body">
                                        <div class="media-body-inset">
                                            <h3>
                                                <?= \yii\helpers\Html::a( $post->$titleLang, Url::to('/blog/view/' . $post->id)) ?>
                                            </h3>
                                            <div class="recent-post-date"><?= $post->date ?></div>
                                        </div>
                                    </div>
                                </div><!-- .media -->
                            <?php } ?>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                    <div class="widget">
                        <h3 class="widget-title"><?= Yii::t('app', 'Archive') ?></h3>
                        <div class="widget-body">
                            <ul class="widget-menu">
                                <li><a href="#">April 2016</a></li>
                                <li><a href="#">August 2016</a></li>
                                <li><a href="#">February 2016</a></li>
                                <li><a href="#">May 2016</a></li>
                            </ul>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </aside><!-- .sidebar -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</section>


