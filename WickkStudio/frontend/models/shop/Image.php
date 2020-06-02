<?php

namespace app\models\shop;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int|null $itemId
 * @property string|null $name
 *
 * @property Shop $item
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemId'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['itemId'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['itemId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Shop::className(), ['id' => 'itemId']);
    }
}
