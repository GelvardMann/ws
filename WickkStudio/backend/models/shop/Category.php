<?php

namespace app\models\shop;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru;
 *
 * @property Shop[] $shops
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ru'], 'required'],
            [['name_en', 'name_ru'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_en' => 'Name',
            'name_ru' => 'Name_ru',
        ];
    }

    /**
     * Gets query for [[Shops]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shop::className(), ['category_id' => 'id']);
    }

    public function getCategoryName($id) {
        $arr = Category::findOne($id);
        return $arr->name_en;
    }


}
