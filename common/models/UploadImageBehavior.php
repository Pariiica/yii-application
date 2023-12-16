<?php

namespace common\models;

use Yii;
use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

class UploadImageBehavior extends Behavior
{
    public $attributes = [];

    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => [$this, 'beforeSave'],
            BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this, 'beforeSave'],
        ];
    }

    public function beforeSave($event)
    {
        foreach ($this->attributes as $attribute) {

            $year_path = '@backend/web/img/' . date('Y') . '/';
            $month_path = $year_path  . date('m') . '/';
            $path = $month_path . date('d') . '/';

            $file = UploadedFile::getInstance($this->owner, $attribute);

            if (!is_dir(Yii::getAlias($path))) {
                mkdir(Yii::getAlias($path), 0755, true);
            }
            if ($file) {
                $filename = $file->baseName . '.' . $file->extension;
                $file->saveAs(Yii::getAlias($path) . '/' . $filename);
                $this->owner->$attribute = $path . '/' . $filename;
            }
        }
    }
}