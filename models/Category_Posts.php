<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_posts".
 *
 * @property integer $category_id
 * @property integer $posts_id
 *
 * @property Posts $posts
 * @property Category $category
 */
class Category_Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'posts_id'], 'required'],
            [['category_id', 'posts_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'posts_id' => 'Posts ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(Posts::className(), ['id' => 'posts_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}