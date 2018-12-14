<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">

        <div class="col-xs-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'brand')->dropDownList(\common\models\Types::types_list(['keys'=>1010])); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'size')->dropDownList(\common\models\Types::types_list(['keys'=>1001])); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'goods_type')->dropDownList(\common\models\Types::types_list(['keys'=>1002])); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'company')->dropDownList(\common\models\Types::types_list(['keys'=>1003])); ?>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
