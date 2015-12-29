<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\models\Posts;

/* @var $this yii\web\View */
/* @var $searchModel app\models\postSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categoriesList array*/

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text_post:ntext',
            [
                'attribute' => 'categoriesList',
                'label' => 'Categories',
                'value' => function (Posts $model) {
                    return implode(', ', ArrayHelper::getColumn($model->categories, 'name'));
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>


