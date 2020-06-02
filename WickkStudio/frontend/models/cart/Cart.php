<?php

namespace app\models\cart;

use app\models\shop\Image;
use yii\helpers\ArrayHelper;
use Yii;
use yii\web\Session;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property string $product_name
 * @property string $collection
 * @property string $description
 * @property int $new
 * @property int $sale
 * @property int $price
 * @property int $salePercent
 * @property int $category_id
 * @property int|null $activite
 *
 * @property Image[] $images
 * @property Category $category
 * @var $session *
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name_ru', 'product_name_en', 'description', 'new', 'sale', 'price', 'salePercent', 'category_id'], 'required'],
            [['new', 'sale', 'price', 'salePercent', 'category_id', 'activite'], 'integer'],
            [['product_name_ru', 'product_name_en', 'collection'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name_en' => 'Product Name',
            'product_name_ru' => 'Product Name',
            'collection' => 'Collection',
            'description' => 'Description',
            'new' => 'New',
            'sale' => 'Sale',
            'price' => 'Price',
            'salePercent' => 'Sale Percent',
            'category_id' => 'Category ID',
            'activite' => 'Activite',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['itemId' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function addToCart($product, $image, $quality)
    {
        $getLang = mb_strtolower('_' . Yii::$app->language);
        $name = 'product_name' . $getLang;
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['quality'] += $quality;
        } else {

            $_SESSION['cart'][$product->id] =
                [
                    'id' => $product->id,
                    'quality' => $quality,
                    'name' => $product->$name,
                    'price' => $product->price,
                    'image' => $image->name,
                ];
        }
        $_SESSION['cart.quality'] = isset($_SESSION['cart.quality']) ? $_SESSION['cart.quality'] + $quality : $quality;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $quality * $product->price : $quality * $product->price;
    }

    public function delProduct($id)
    {
        $session = Yii::$app->session;
        $session->open();
        unset($_SESSION['cart'][$id]);
        $quality = array_sum(ArrayHelper::getColumn($session['cart'], 'quality'));
        $result = null;
        if (!empty($session)) {
            foreach ($session['cart'] as $product) {
                $res = $product['price'] * $product['quality'];
                $result += $res;
            }
        }
        $_SESSION['cart.quality'] = $quality;
        $_SESSION['cart.sum'] = $result;
    }
}
