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
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => [$this, 'beforeValidate'],
            BaseActiveRecord::EVENT_BEFORE_INSERT => [$this, 'beforeSave'],
            BaseActiveRecord::EVENT_BEFORE_UPDATE => [$this, 'beforeSave'],
            BaseActiveRecord::EVENT_AFTER_DELETE => [$this, 'afterDelete'],
        ];
    }

    public function beforeValidate()
    {
        foreach ($this->attributes as $attribute) {
            if ($this->owner->$attribute instanceof UploadedFile) {
                $this->owner->$attribute;
            } else {
                UploadedFile::getInstance($this->owner, $attribute);
            }
        }
    }

    /**
     * @throws Exception
     */
    public function beforeSave($event)
    {
        foreach ($this->attributes as $attribute) {

            if ($file = UploadedFile::getInstance($this->owner, $attribute)) {

                $date = date('Y/m/d');
                $path = '@backend/web/img/' . $date;
                $file = UploadedFile::getInstance($this->owner, $attribute);

                if (!is_dir(Yii::getAlias($path))) {
                    mkdir(Yii::getAlias($path), 0755, true);
                }
                if ($file) {

                    $fileName = Yii::$app->security->generateRandomString(8) . '_' . time() . '.' . $file->extension;
                    $file->saveAs(Yii::getAlias($path) . '/' . $fileName);
                    $result = $this->owner->$attribute = $date . '/' . $fileName;
                    return $result ? ($date . '/' . $fileName) : null;
                }
            } else {
                $this->owner->addError($attribute, Yii::t('app', '{attribute} file not saved!', ['attribute' => $attribute]));
            }
        }
        return false;
    }
    public function afterDelete($event)
    {
        foreach ($this->attributes as $attribute) {

            if (isset($event->sender->attributes[$attribute])) {
                $path = $event->sender->attributes[$attribute];


                if (empty($path) || $path == '') {
                    return;
                }
                try {
                    $filePath = Yii::getAlias($path);

//                    if (!file_exists($filePath)) {
//                        Yii::error('not exist');
//                    } else {
                        $a =  unlink('@backend/web/img/'. $filePath);
                        Yii::debug($a, 'aaaaa 4');
//
//                    }
                } catch (\Exception $e) {
                    Yii::error($e->getMessage(), __METHOD__);
                }
            }
        }
    }
}