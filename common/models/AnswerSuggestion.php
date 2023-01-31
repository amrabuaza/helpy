<?php
/**
 * Created by PhpStorm.
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "AnswerSuggestion".
 *
 * @property int $id
 * @property string $problem
 * @property string $solution
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Category $category
 */
class AnswerSuggestion extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer_suggestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['solution', 'problem', 'category_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['solution', 'problem'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'problem' => Yii::t('app','Problem'),
            'solution' => Yii::t('app','Solution'),
            'category_id' => Yii::t('app','Category name'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}