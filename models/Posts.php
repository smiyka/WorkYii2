<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $text_post
 *
 * @property CategoryPosts[] $categoryPosts
 */
class Posts extends \yii\db\ActiveRecord
{
    public $categori_ids;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_post'], 'required'],
            [['text_post'], 'string'],
            [['categori_ids'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_post' => 'Text Post',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('category_posts', ['posts_id' => 'id']);
    }
}