<?php

namespace app\models\blog;

use app\models\shop\Image;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property string $content_ru
 * @property string $content_en
 * @property string $date
 * @property string $links
 * @property string $image
 */
class Blog extends \yii\db\ActiveRecord
{
    public $images;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_en', 'content_ru', 'content_en', 'date', 'links',], 'required'],
            [['content_ru', 'content_en', 'links'], 'string'],
            [['date'], 'safe'],
            [['title_ru', 'title_en'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Title Ru',
            'title_en' => 'Title En',
            'content' => 'Content',
            'date' => 'Date',
            'links' => 'Links',
            'image' => 'Image',
        ];
    }

    public function deleteFolder($id)
    {
        $path = Yii::getAlias('@pathBlog' . '/' . $id);
        if (file_exists($path)) {
            $del = $path;
            $del = escapeshellarg($del);
            exec("rmdir /s /q $del");
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $images = $this->image = UploadedFile::getInstance($this, 'image');
            $name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $images->extension;
        }

        return $this->image = $name;

    }

    public function afterSave($insert, $changedAttributes)
    {
        $name = $this->image;
        $path = Yii::getAlias('@pathBlog' . '/' . $this->id);
        $images = $this->image = UploadedFile::getInstance($this, 'image');
        if (file_exists($path)) {
            $del = $path;
            $del = escapeshellarg($del);
            exec("rmdir /s /q $del");
        }
        mkdir($path);
        $images->saveAs($path . '/' . $name);

        parent::afterSave($insert, $changedAttributes);
    }
}
