<?php

namespace app\models\cart;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "orders_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_name
 * @property int $price
 * @property int $quality
 * @property int $sum_items
 *
 * @property Orders $order
 */
class OrdersItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_name', 'price', 'quality', 'sum_items'], 'required'],
            [['order_id', 'product_id', 'price', 'quality', 'sum_items'], 'integer'],
            [['product_name'], 'string', 'max' => 50],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
