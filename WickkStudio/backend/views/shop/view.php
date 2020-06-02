<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\shop\Shop */
/* @var $images app\models\shop\Image */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shop-view">

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
        <?php

        $images = new \app\models\shop\Image();
        ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'product_name_ru',
                'product_name_en',
                'collection',
                'description_ru',
                'description_en',
                [
                    'attribute' => 'new',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->new ? '<span class="label label-success">NEW</span>' : '<span class="label label-danger">NO</span>';
                    }
                ],
                [
                    'attribute' => 'sale',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->sale ? '<span class="label label-success">SALE</span>' : '<span class="label label-danger">NO</span>';
                    }
                ],
                'price',
                'salePercent',
                [
                    'attribute' => 'category_id',
                    'value' => (new app\models\shop\Category)->getCategoryName($model->category_id),
                ],
                [
                    'attribute' => 'activite',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->activite ? '<span class="label label-success">ACTIVE</span>' : '<span class="label label-danger">NOT ACTIVE</span>';
                    }
                ],
                [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function ($data) {
                        $arr = (new \app\models\shop\Image)->getImages($data->id);

                        $images = array();
                        foreach ($arr as $items) {
                           $images[] = Html::img(Yii::$app
                               ->urlManagerF
                               ->createUrl('uploads/images/'
                                   . $items['itemId']
                                   . '/'
                                   . $items['name']),
                               ['style' => [
                                  'max-width' => '120px',
                                   'margin' => '20px'
                               ]]);

                        }
                        return implode('', $images);
                                }

                ]

            ],
        ]); ?>

</div>
