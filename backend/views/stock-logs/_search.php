<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockLogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'purpose_id')
                ->dropDownList(\common\models\Types::types_list(['keys'=>1009])); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'stock_id')
                ->dropDownList(\common\models\Stock::getDropDownList()); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'customer_id')
                ->dropDownList(\common\models\Customer::getDropDownList()); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'status')
                ->dropDownList(\common\models\StockLogs::getDropDownListStatus()); ?>
        </div> <div class="col-xs-3">
            <?= $form->field($model, 'is_returns')
                ->dropDownList(\common\models\StockLogs::getDropDownListIsReturns()); ?>
        </div>
    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'purpose_id') ?>

    <?php // echo $form->field($model, 'is_returns') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'add_user') ?>

    <?php // echo $form->field($model, 'operation_time') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'create_at') ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
        <button type="button"  class="btn btn-danger">导出Excel</button>

    </div>

    <?php ActiveForm::end(); ?>

</div>
