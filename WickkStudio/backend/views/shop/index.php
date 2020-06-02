<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\shop\shopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_name_ru',
            'product_name_en',
            'collection',
            [
                'attribute' => 'new',
                'format' => 'raw',
                'filter' => [
                    0 => 'No',
                    1 => 'New',
                ],
                'value' => function ($model, $key, $index, $column) {
                    $new = $model->{$column->attribute} === 1;
                    return \yii\helpers\Html::tag(
                        'span',
                        $new ? 'New' : 'No',
                        [
                            'class' => 'label label-' . ($new ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            [
                'attribute' => 'sale',
                'format' => 'raw',
                'filter' => [
                    0 => 'No',
                    1 => 'Sale',
                ],
                'value' => function ($model, $key, $index, $column) {
                    $sale = $model->{$column->attribute} === 1;
                    return \yii\helpers\Html::tag(
                        'span',
                        $sale ? 'Sale' : 'No',
                        [
                            'class' => 'label label-' . ($sale ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            'price',
            'salePercent',
            [
                'attribute' => 'category_id',
                'value' => function ($data) {
                  return (new app\models\shop\Category)->getCategoryName($data->category_id);
                },


            ],
            [
                'attribute' => 'activite',
                'format' => 'raw',
                'filter' => [
                    0 => 'No',
                    1 => 'Yes',
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === 1;
                     return \yii\helpers\Html::tag(
                        'span',
                        $active ? 'Yes' : 'No',
                        [
                            'class' => 'label label-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],


        ],
    ]); ?>


</div>
