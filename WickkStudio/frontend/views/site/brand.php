<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Brand';
$this->params['breadcrumbs'][] = mb_strtoupper($this->title);
?>
    <section class="wrapper">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>This is the Brand page. You may modify the following file to customize its content:</p>

        <code><?= __FILE__ ?></code>
    </section>
<?php
