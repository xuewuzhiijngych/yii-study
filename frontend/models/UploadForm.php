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
            chdir(Yii::getAlias('@uploads'));
            $dir = date('Ymd');
            $fileName = randStr(16) . rand(100, 999);
            if (!file_exists($dir)) {
                mkdir($dir, 0777);
            }
            $this->imageFile->saveAs(Yii::getAlias('@uploads') . "/$dir/" . $fileName . '.' . $this->imageFile->extension);
        } else {
            return false;
        }
    }

}