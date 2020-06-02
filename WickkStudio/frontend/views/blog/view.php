<?php

/* @var $this yii\web\View */
/* @var $data */
/* @var $latestPosts */

$getLang = mb_strtolower('_' . Yii::$app->language);
$titleLang = 'title' . $getLang;
$contentLang = 'content' . $getLang;

$this->params['breadcrumbs'][] = [
    'label' => mb_strtoupper(Yii::t('app', 'Blog')),
    'url' => '/blog'
];
$this->params['breadcrumbs'][] = mb_strtoupper($data[array_key_first($data)]->$titleLang);

// Yii::t('app', 'Read more')
?>

<section class="blog-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 indent-top">
                <?php foreach ($data as $post) { ?>
                    <div class="blog-item single-blog-item">
                        <h2 class="text-uppercase">
                            <?= \yii\helpers\Html::a($post->$titleLang, $post->links, ['target' => '_blank']) ?>
                        </h2>
                        <div class="blog-media">
                            <div>
                                <?php if (!empty($post->image)) { ?>
                                    <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/blog/' . $post->id . '/' . $post->image)) ?>
                                <?php } else { ?>
                                    <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/images/noImage.jpg')) ?>
                                <?php } ?>
                            </div><!-- End "about-slider" -->
                        </div><!-- .blog-media -->
                        <div class="blog-item-body">
                            <div class="blog-item-data"><?= Yii::$app->formatter->asDate($post->date, 'php:d, M yy'); ?></div>
                            <p><?= $post->$contentLang ?></p>
                        </div><!-- .blog-item-body -->
                    </div><!-- .blog-post -->
                <?php } ?>
                <div class="social-feedback">
                    <?= \yii\helpers\Html::a('Instagramm', $post->links,
                        [
                            'target' => '_blank',
                            'class' => 'common-btn'
                        ]) ?>
                </div><!-- .social-feedback -->

            </div><!-- .col -->
            <div class="col-sm-4 indent-top">
                <aside class="sidebar">
                    <div class="widget">
                        <h3 class="widget-title"><?= Yii::t('app', 'Latest posts') ?></h3>
                        <div class="widget-body">
                            <?php foreach ($latestPosts as $post) { ?>
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="<?= \yii\helpers\Url::to('/blog/view/' . $post->id) ?>">
                                            <?php if (!empty($post->image)) { ?>
                                                <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/blog/' . $post->id . '/' . $post->image),
                                                    [
                                                        'alt' => $post->$titleLang,
                                                        'class' => 'media-object'
                                                    ]) ?>
                                            <?php } else { ?>
                                                <?= \yii\helpers\Html::img(\yii\helpers\Url::to('/uploads/images/noImage.jpg'),
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
                                                <?= \yii\helpers\Html::a($post->$titleLang, \yii\helpers\Url::to('/blog/view/' . $post->id)) ?>
                                            </h3>
                                            <div class="recent-post-date"><?= $post->date ?></div>
                                        </div>
                                    </div>
                                </div><!-- .media -->
                            <?php } ?>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </aside><!-- .sidebar -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</section>

