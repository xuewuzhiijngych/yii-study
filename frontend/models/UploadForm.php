<?php


namespace frontend\models;


use Yii;
use yii\base\Model;

class UploadForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::getAlias('@uploads') . '/frontend/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
        } else {
            return false;
        }
    }

}