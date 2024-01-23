<?php

namespace common\models;

use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\base\Model;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;

class UploadImageBehavior extends Behavior
{
    public $attributes = [];

    public function events(): array
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => [$this, 'beforeValidate'],
//            BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this, 'beforeSave'],
            BaseActiveRecord::EVENT_BEFORE_DELETE => [$this, 'beforeDelete'],
        ];
    }

    public function beforeValidate()
    {
        foreach ($this->attributes as $attribute) {
            $this->owner->$attribute = UploadedFile::getInstance($this->owner, $attribute);
            if ($this->owner->$attribute instanceof UploadedFile) {
                $this->owner->upload($attribute);

            }
        }
    }

    /**
     * @throws Exception
     */
//    public function beforeSave($event)
//    {
//        foreach ($this->attributes as $attribute) {
//
//            if ($file = UploadedFile::getInstance($this->owner, $attribute)) {
//
//                $date = date('Y/m/d');
//                $path = '@backend/web/img/' . $date;
//                $file = UploadedFile::getInstance($this->owner, $attribute);
//
//                if (!is_dir(Yii::getAlias($path))) {
//                    mkdir(Yii::getAlias($path), 0755, true);
//                }
//                if ($file) {
//
//                    $fileName = Yii::$app->security->generateRandomString(8) . '_' . time() . '.' . $file->extension;
//                    $file->saveAs(Yii::getAlias($path) . '/' . $fileName);
//                    $result = $this->owner->$attribute = $date . '/' . $fileName;
//                    return $result ? ($date . '/' . $fileName) : null;
//                }
//            } else {
//                $this->owner->addError($attribute, Yii::t('app', '{attribute} file not saved!', ['attribute' => $attribute]));
//            }
//        }
//        return false;
//    }
    public function upload($attribute)
    {

        $date = date('Y/m/d');
        $folderPath = Yii::getAlias('@backend/web/img/') . $date;
        if (!is_dir($folderPath)) {
            mkdir($folderPath,0777,true);
        }

        $time = time();
        $path = Yii::getAlias('@backend/web/img/') . $date. '/'. $time . '.' . $this->owner->$attribute->extension;
        $pathName = $date. '/' . $time  .  '.' . $this->owner->$attribute->extension;
        $this->owner->$attribute->saveAs($path);
        $this->owner->$attribute = $pathName;

    }
//    public function afterDelete($event)
//    {
//        foreach ($this->attributes as $attribute) {
//
//            if (isset($event->sender->attributes[$attribute])) {
//                $path = $event->sender->attributes[$attribute];
//
//
//                if (empty($path) || $path == '') {
//                    return;
//                }
//                try {
//                    $filePath = Yii::getAlias($path);
//
////                    if (!file_exists($filePath)) {
////                        Yii::error('not exist');
////                    } else {
//                        $a =  unlink('@backend/web/img/'. $filePath);
//                        Yii::debug($a, 'aaaaa 4');
////
////                    }
//                } catch (\Exception $e) {
//                    Yii::error($e->getMessage(), __METHOD__);
//                }
//            }
//        }
//    }

    public function beforeDelete($attribute)
    {
        foreach ($this->attributes as $attribute) {
            $filePath = Yii::getAlias('@backend/web/web/'). $this->owner->$attribute;
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }

}