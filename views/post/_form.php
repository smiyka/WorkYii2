<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text_post')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'categori_ids')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Category::find()->all(),'id','name'),
            'language' => 'en',
            'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
//        dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Category::find()
//            ->all(),'id','name')
//        ])]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
