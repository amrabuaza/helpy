<?php

namespace common\models\translation;

use common\models\ActiveRecord;
use common\models\Article;

/**
 * This is the model class for table "article_language".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $article_id
 * @property string $language
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Article $article
 */
class ArticleLanguage extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'article_id', 'language'], 'required'],
            [['article_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'description', 'language'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'article_id' => 'article ID',
            'language' => 'Language',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}