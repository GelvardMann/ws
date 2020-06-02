<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\blog\Blog */

$this->title = $model->title_en;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title_ru',
            'title_en',
            'content_ru:ntext',
            'content_en:ntext',
            'date',
            'links:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($data) {

                    return $test = \yii\helpers\Html::img(Yii::$app
                        ->urlManagerF
                        ->createUrl('/uploads/blog/' . $data->id . '/' . $data->image),
                        ['style' => [
                            'max-width' => '300px',
                        ]]);
                }

            ]

        ],
    ]) ?>

</div>
