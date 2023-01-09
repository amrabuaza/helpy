<?php

namespace common\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function  behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->isNewRecord) {
                $this->updated_at = date("Y-m-d H:i:s");
            } else if ($this->isNewRecord) {
                $this->created_at = date("Y-m-d H:i:s");
            }
            return true;
        }
        return false;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getCreatedSince()
    {
        $oneWeekAgo  = strtotime('-1 week');
        $createdDate = $this->created_at;

        if($createdDate > $oneWeekAgo) {
            return Yii::$app->formatter->asRelativeTime($createdDate);
        } else {
            return Yii::$app->formatter->asDate($createdDate, 'long');
        }
    }
}