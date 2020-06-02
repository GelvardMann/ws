<?php

namespace frontend\controllers;

use Yii;
use app\models\shop\Shop;
use yii\data\Pagination;


class ShopController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = new Shop();
        $category = $data->getAllCategory();
        $products = $data->getAllProducts();
        $products['items'] = $data->getImagesForProducts($products['items']);
        return $this->render('index', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function actionCategory() {
        $nameCategory = Yii::$app->request->get('name');
        $data = new Shop();
        $products = $data->getAllProducts($nameCategory);
        $products['items'] = $data->getImagesForProducts($products['items']);
        $category = $data->getAllCategory();
        return $this->render('index', [
            'products' => $products,
            'category'=> $category,
            'nameCategory' => $nameCategory
        ]);
    }

    public function actionView($id)
    {
        $data = new Shop();
        $products = $data->getProduct($id);
        $products = $data->getImagesForProducts($products);
        $category = $data->getAllCategory();
        return $this->render('view', [
            'products' => $products,
            'category'=> $category
        ]);
    }



}
