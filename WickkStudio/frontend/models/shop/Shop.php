<?php

namespace app\models\shop;

use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\db\pgsql\QueryBuilder;
use yii\db\Query;
use yii\helpers\ArrayHelper;


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
 * @property array $data
 *
 * @property Image[] $images
 * @property Category $category
 */
class Shop extends \yii\db\ActiveRecord
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
            [['product_name', 'collection', 'description', 'new', 'sale', 'price', 'salePercent', 'category_id'], 'required'],
            [['new', 'sale', 'price', 'salePercent', 'category_id', 'activite'], 'integer'],
            [['product_name', 'collection'], 'string', 'max' => 20],
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
            'product_name' => 'Product Name',
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

    public function getAllCategory()
    {
        $data = Yii::$app->db->cache(function () {

    });

        return $data = Category::find()->all();

    }

    public function getImagesForProducts($products)
    {
        $products = ArrayHelper::index($products, 'id');
        $ids = ArrayHelper::getColumn($products, 'id');
        $images = Image::find()->where(['itemId' => $ids])->asArray()->all();
        foreach ($products as $product) {
            foreach ($images as $image) {
                if ($image['itemId'] == $product['id']) {
                    $result[$product['id']][] = $image['name'];
                }
            }
        }
        foreach ($products as $product) {
            $products[$product['id']]['images'] = $result[$product['id']];

        }

        return $products;
    }

    public function getAllProducts($nameCategory = null)
    {
        $data = array();
        $query = new Query();
        if (!empty($nameCategory)) {
            $categoryId = Category::find()
                ->where(
                    [
                        'name_ru' => $nameCategory
                    ])
                ->orWhere(
                    [
                        'name_en' => $nameCategory
                    ]
                )
                ->one();
            if (!empty($categoryId)) {
                $query->select('*')
                    ->from('shop')
                    ->where(
                        [
                            'category_id' => $categoryId->id
                        ])
                    ->all();
            } else {
                $query->select('*')
                    ->from('shop');
            }
        } else {
            $query->select('*')
                ->from('shop');
        }

        $data['pages'] = new Pagination(
            [
                'totalCount' => $query->count(),
                'pageSize' => 10,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]);
        $data['items'] = $query->offset($data['pages']->offset)
            ->limit($data['pages']->limit)
            ->All();
        return $data;

    }

    public function getProduct($id)
    {
        $data = array();
        $query = new Query();
        $query->select('*')
            ->from('shop')
            ->where([
                'id' => $id
            ]);

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $data;
    }

    public function getNewSaleProducts()
    {
        $query = new Query();
        $query->select('*')
            ->from('shop')
            ->where([
                'new' => true,
                'activite' => true
            ])
            ->orWhere([
                'sale' => true,
                'activite' => true]);
        $command = $query->createCommand();
        return $data = $command->queryAll();
    }

    public function getTest()
    {
        $query = new Query();
        $query->select('*')
            ->from('shop')
            ->where([
                'new' => true,
                'activite' => true
            ])
            ->orWhere([
                'sale' => true,
                'activite' => true]);
        $command = $query->createCommand();
        return $data = $command->queryAll();
    }

}
