<?php


namespace frontend\models;

use yii\db\ActiveRecord;

class ProjectAdmin extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%project_admin}}';
    }



}