<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!--    --><? //= $form->field($model, 'id') ?>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'address') ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'customer_id')
                ->dropDownList(\common\models\Customer::getDropDownList()); ?>
        </div>
        <div class="col-xs-3">
            <?= $form->field($model, 'orders_type')->dropDownList(\common\models\Types::types_list(['keys' => 1013])); ?>
        </div>
        <!--    --><? //= $form->field($model, 'start_time') ?>

        <?php // echo $form->field($model, 'end_time') ?>

        <?php // echo $form->field($model, 'phone') ?>

        <?php // echo $form->field($model, 'work_cost') ?>

        <?php // echo $form->field($model, 'freight_cost') ?>

        <?php // echo $form->field($model, 'remark') ?>

        <?php // echo $form->field($model, 'status') ?>

        <?php // echo $form->field($model, 'token') ?>

        <?php // echo $form->field($model, 'add_user') ?>

        <?php // echo $form->field($model, 'update_at') ?>

        <?php // echo $form->field($model, 'create_at') ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
        <button type="button"  class="btn btn-danger">导出Excel</button>

    </div>

    <?php ActiveForm::end(); ?>

</div>
