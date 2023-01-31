<?php
/**
 * Created by PhpStorm.
 * Developer : Amr Abu Aza
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $priority
 * @property int $user_id
 * @property int $category_id
 * @property string $phone_number
 * @property string $latitude
 * @property string $longitude
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $answered_at
 *
 * @property Category $category
 * @property User $user
 * @property RequestAnswer[] $requestAnswers
 * @property string $status
 */
class Request extends ActiveRecord
{
    public $address;
    const PRIORITIES = [
        0 => 'high',
        1 => 'middle',
        2 => 'low',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->address)) {
                $part = explode("@", $this->address);
                if (count($part) == 2) {
                    $this->latitude = $part[0];
                    $this->longitude = $part[1];
                }
            }
            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (count($this->requestAnswers) == 0) {
            $answerSuggestion = AnswerSuggestion::find()->where(['like', 'problem', $this->title])->andWhere(['category_id' => $this->category_id])->one();
            if (!is_null($answerSuggestion)) {
                $answer = new RequestAnswer();
                $answer->request_id  = $this->id;
                $answer->answered_by = Yii::$app->user->id;
                $answer->content     = $answerSuggestion->solution;
                $answer->save();
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'user_id', 'priority', 'phone_number'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['description'], 'string', 'min' => 100],
            [['address'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'title'),
            'description' => Yii::t('app', 'description'),
            'priority' => Yii::t('app', 'priority'),
            'category_id' => Yii::t('app', 'Category name'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RequestAnswer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestAnswers()
    {
        return $this->hasMany(RequestAnswer::className(), ['request_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public static function priorities()
    {
        $priorities = [];
        foreach (self::PRIORITIES as $key => $value) {
            $priorities[$key] = Yii::t('app', "request.priority.$value");
        }
        return $priorities;
    }

    public function getStatus()
    {
        return is_null($this->answered_at) ? 'pending' : 'answered';
    }
}