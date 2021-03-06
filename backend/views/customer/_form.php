<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <div class="col-xs-6 col-xs-offset-3">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'customer_type')->textInput() ?>

<!--    --><?//= $form->field($model, 'source_type')->textInput() ?>
    <?= $form->field($model, 'customer_type')->dropDownList(Types::types_list(['keys'=>1005])); ?>
    <?= $form->field($model, 'source_type')->dropDownList(Types::types_list(['keys'=>1006])); ?>
    <?= $form->field($model, 'status')->dropDownList(Types::types_list(['keys'=>1007])); ?>
    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
<!--    --><?//= $form->field($model, 'token')->textInput() ?>

<!--    --><?//= $form->field($model, 'add_user')->textInput() ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '创建') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
