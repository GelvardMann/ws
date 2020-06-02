<?php

namespace app\models\shop;

use Yii;
use app\models\shop\image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property string $product_name_ru
 * @property string $product_name_en
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
 */
class Shop extends \yii\db\ActiveRecord
{
    public $image;

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
            [['product_name_ru','product_name_en', 'collection', 'description_ru','description_en', 'new', 'sale', 'price', 'salePercent', 'category_id'], 'required'],
            [['new', 'sale', 'price', 'salePercent', 'category_id', 'activite'], 'integer'],
            [['product_name_ru', 'product_name_en', 'collection'], 'string', 'max' => 20],
            [['description_ru', 'description_en'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name_ru' => 'Product Name ru',
            'product_name_en' => 'Product Name en',
            'collection' => 'Collection',
            'description_ru' => 'Description ru',
            'description_en' => 'Description en',
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

    public function afterSave($insert, $changedAttributes)
    {
        $images = $this->image = UploadedFile::getInstances($this, 'image');

        if ($images) {
            $namesImages = array();

            if ($this->validate()) {
                $path = Yii::getAlias('@pathShop' . '/' . $this->id);
                if (file_exists($path)) {
                    $del = $path;
                    $del = escapeshellarg($del);
                    exec("rmdir /s /q $del");
                    $deleteFromDb = \app\models\shop\Image::deleteAll(['itemId' => $this->id]);
                }
                mkdir($path);

                foreach ($images as $file) {
                    $name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $file->extension;
                    $file->saveAs($path . '/' . $name);
                    $namesImages[] = $name;
                }
            }

            foreach ($namesImages as $item) {
                $data = new \app\models\shop\Image();
                $data->itemId = $this->id;
                $data->name = $item;
                $data->save();
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {

            $path = Yii::getAlias('@pathShop') . '/' . $this->id;
            $images = \app\models\shop\Image::findAll(['itemId' => $this->id]);
            foreach ($images as $image) {
                if (file_exists($path . '/' . $image->name)) {
                    unlink($path . '/' . $image->name);
                    $image->delete();
                }
            }
            if (file_exists($path)) {
                rmdir($path);
            }
            return true;
        } else {
            return false;
        }

    }

}
