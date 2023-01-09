<?php
/**
 * Created by PhpStorm.
 */

namespace common\models\user;

use common\models\ActiveRecord;
use common\models\Category;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "admin_category".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 *
 * @property User $user
 * @property Category $category
 */
class AdminCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'required'],
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
            'user_id' => Yii::t('app','user_id'),
            'category_id' => Yii::t('app','category_id'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}