<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-xs-3">
            <?= $form->field($model, 'customer_type')->dropDownList(\common\models\Types::types_list(['keys'=>1005])); ?>
        </div>

        <div class="col-xs-3">
        <?= $form->field($model, 'source_type')->dropDownList(\common\models\Types::types_list(['keys'=>1006])); ?>
        </div> <div class="col-xs-3">
        <?= $form->field($model, 'status')->dropDownList(\common\models\Types::types_list(['keys'=>1007])); ?>
        </div> </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
        <button type="button"  class="btn btn-danger">导出Excel</button>

        <!--        --><?//= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
