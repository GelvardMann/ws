<?php


namespace backend\models\site;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

use yii\helpers\Html;


class Site extends Model
{
    public $mainImage;
    public $secondMainImage;

    public function rules()
    {

        return [
            [['mainImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxFiles' => 1],
            [['secondMainImage'], 'string', 'max' => 255],
        ];
    }

    public function saveImages()
    {
        $attributeArr = $this->activeAttributes();
        foreach ($attributeArr as $attribute) {
            $image = $this->$attribute = UploadedFile::getInstance($this, $attribute);
            if ($image) {
                $imageName = $attribute . '.' . $image->extension;
                $path = Yii::getAlias('@pathMainImage' . '/' . $imageName);
                $pathBackup = Yii::getAlias('@pathMainImage' . '/backup/' . $imageName);
                if (file_exists($path)) {
                    if (file_exists($pathBackup)) {
                        unlink($pathBackup);
                    }
                    rename($path, $pathBackup);
                }
                $image->saveAs($path);
            }
        }
    }


    public function backupImage()
    {

        $attributeArr = $this->activeAttributes();
        foreach ($attributeArr as $attribute) {
            if (!empty($attribute)) {
                $imageName = $attribute . '.jpg';
                $path = Yii::getAlias('@pathMainImage' . '/' . $imageName);
                $pathBackup = Yii::getAlias('@pathMainImage' . '/backup/' . $imageName);
                $pathTemp = Yii::getAlias('@pathMainImage' . '/temp');
                if (file_exists($pathBackup)) {
                    if (file_exists($path)) {
                        file_exists($pathTemp) ? $this->delDir($pathTemp) :  mkdir($pathTemp);
                        rename($path, $pathTemp . '/' . $imageName);
                        rename($pathBackup, $path);
                        rename($pathTemp . '/' . $imageName, $pathBackup);
                        rmdir($pathTemp);
                    }
                }
            }
        }
    }

    public  function delDir($path)
    {
        $dir = opendir($path);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $path . '/' . $file;
                if ( is_dir($full) ) {
                    delDir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($path);
    }
}