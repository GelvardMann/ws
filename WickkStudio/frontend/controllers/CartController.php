<?php

namespace frontend\controllers;

use Yii;
use app\models\shop\Shop;
use app\models\shop\Image;
use app\models\cart\Cart;
use yii\helpers\Url;
use app\models\cart\Orders;
use app\models\cart\OrdersItems;

/* @var $id */
class CartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $order = new Orders();
        if ($order->load(Yii::$app->request->post())) {
            $order->quality = $session['cart.quality'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderProducts($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Done');
                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom('timoffey119@gmail.com')
                    ->setTo($order->email)
                    ->setSubject('Wickk Studio Order')
                    ->send();
                $session->remove('cart');
                $session->remove('cart.sum');
                $session->remove('cart.quality');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Error');
            }

        }
        $this->layout = 'NoMainImage';
        return $this->render('index', compact('session', 'order'));
    }

    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $quality = Yii::$app->request->get('count');
        $session = Yii::$app->session;
        $session->open();
        $product = Shop::findOne($id);
        $image = Image::find()->where(['itemId' => $id])->one();
        $cart = new Cart();
        $cart->addToCart($product, $image, $quality);
        $this->layout = false;
        return $this->render('modal', compact('session'));
    }

    public function actionDel()
    {

        $id = Yii::$app->request->get('id');
        $item = new Cart();
        $item->delProduct($id);
        Yii::$app->response->redirect(Url::to('/cart/index'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.quality');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('modal', compact('session'));
    }

    protected function saveOrderProducts($products, $orderId)
    {
        foreach ($products as $product) {
            $orderProducts = new OrdersItems();
            $orderProducts->order_id = $orderId;
            $orderProducts->product_id = $product['id'];
            $orderProducts->product_name = $product['name'];
            $orderProducts->price = $product['price'];
            $orderProducts->quality = $product['quality'];
            $orderProducts->sum_items = $product['quality'] * $product['price'];
            $orderProducts->save();
        }
    }

}
