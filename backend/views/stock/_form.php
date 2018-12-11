<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">
    <div class="col-xs-6 col-xs-offset-3">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput() ?>

<!--    --><?//= $form->field($model, 'token')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'size')->textInput() ?>
        <?= $form->field($model, 'brand')->dropDownList(Types::types_list(['keys'=>1010])); ?>
        <?= $form->field($model, 'size')->dropDownList(Types::types_list(['keys'=>1001])); ?>
        <?= $form->field($model, 'goods_type')->dropDownList(Types::types_list(['keys'=>1002])); ?>
        <?= $form->field($model, 'company')->dropDownList(Types::types_list(['keys'=>1003])); ?>

<!--    --><?//= $form->field($model, 'goods_type')->textInput() ?>

<!--    --><?//= $form->field($model, 'company')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ext1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ext2')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '创建') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
