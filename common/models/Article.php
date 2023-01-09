<?php
/**
 * Created by PhpStorm.
 */

namespace common\models;

use common\helper\Constants;
use common\models\translation\ArticleLanguage;
use omgdef\multilingual\MultilingualBehavior;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $status
 * @property string|null $slug
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property ArticleLanguage[] $ArticleLanguage
 */
class Article extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','title'),
            'description' => Yii::t('app','description'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'ml' => [
                'class' => MultilingualBehavior::className(),
                'languages' => Yii::$app->params[Constants::LANGUAGES],
                'languageField' => 'language',
                'dynamicLangClass' => true,
                'langClassName' => ArticleLanguage::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => 'en-US',
                'langForeignKey' => 'article_id',
                'tableName' => "{{%article_language}}",
                'attributes' => [
                    'title',
                    'description'
                ]
            ]
        ];
    }

    /**
     * Gets query for [[ArticleLanguage]].
     *
     * @return ActiveQuery
     */
    public function getArticleLanguage()
    {
        return $this->hasMany(ArticleLanguage::className(), ['article_id' => 'id']);
    }
}