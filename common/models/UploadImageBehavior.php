<?php

namespace common\models;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

class UploadImageBehavior extends Behavior
{
    public $attributes = [];
    public $value = [];

    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => [$this, 'beforeSave'],
            BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this, 'beforeSave'],
        ];
    }

    public function beforeSave($event)
    {

        $attributes = $this->attributes;
        $model = $this->owner;
        $date = date('Y-m-d');
        $path = '@backend/web/img/' . $date;
        $file = UploadedFile::getInstance( $this->owner, $attributes);

        if (!is_dir(Yii::getAlias($path))) {
            mkdir(Yii::getAlias($path), 0755, true);
        }
        if ($file) {
            $filename = $file->baseName . '.' . $file->extension;
            $file->saveAs(Yii::getAlias($path) . '/' . $filename);
            $this->owner->$attributes = $path . '/' . $filename;
        }
    }
}