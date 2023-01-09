<?php
/**
 * Created by PhpStorm.
 */

namespace common\models;

use common\helper\Constants;
use common\models\translation\CategoryLanguage;
use common\models\user\AdminCategory;
use omgdef\multilingual\MultilingualBehavior;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $status
 * @property string|null $slug
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Request[] $requests
 * @property CategoryLanguage[] $categoryLanguages
 * @property User $admin
 * @property AdminCategory $adminCategory
 */
class Category extends ActiveRecord
{
    public $user_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['created_at', 'updated_at', 'user_id'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','name'),
            'description' => Yii::t('app','description'),
            'user_id' => Yii::t('app','Admin username'),
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
                'langClassName' => CategoryLanguage::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => 'en-US',
                'langForeignKey' => 'category_id',
                'tableName' => "{{%category_language}}",
                'attributes' => [
                    'name',
                    'description'
                ]
            ]
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[AdminCategory]].
     *
     * @return ActiveQuery
     */
    public function getAdminCategory()
    {
        return $this->hasOne(AdminCategory::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getAdmin()
    {
        return $this->adminCategory->user;
    }

    /**
     * Gets query for [[CategoryLanguages]].
     *
     * @return ActiveQuery
     */
    public function getCategoryLanguages()
    {
        return $this->hasMany(CategoryLanguage::className(), ['category_id' => 'id']);
    }
}