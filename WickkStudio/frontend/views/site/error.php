<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = [
    'label' => $name
];
?>

<section class="white-block">
    <div class="portfolio-filter_custom">
        <ul>
            <li class="active-menu"><a href="/">Home</a></li>
            <li>
                <?=Html::a('Shop',[\yii\helpers\Url::to(['/shop'])])?>
            </li>
            <li>
                <?=Html::a('Blog',[\yii\helpers\Url::to(['/blog'])])?>
            </li>
            <li>
                <?=Html::a('Brand',[\yii\helpers\Url::to(['/brand'])])?>
            </li>
            <li>
                <?=Html::a('Contacts',[\yii\helpers\Url::to(['/contacts'])])?>
            </li>
        </ul>
    </div>
</section>
