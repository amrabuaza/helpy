<?php
/**
 * Created by PhpStorm.
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $content
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $request_id
 * @property int $answered_by
 *
 * @property Request $request
 * @property string $answeredUsername
 */
class RequestAnswer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_answer';
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert && is_null($this->request->answered_at)) {
            $this->request->answered_at = date("Y-m-d H:i:s");
            $this->request->save();
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'answered_by', 'request_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => Yii::t('app', 'content'),
            'answered_by' => Yii::t('app', 'answered_by'),
            'request_id' => Yii::t('app', 'request_id'),
            'answeredUsername' => Yii::t('app', 'answered_by'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * @return string
     */
    public function getAnsweredUsername()
    {
        return User::findOne($this->answered_by)->username;
    }
}