<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FinanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="finance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <div class="row">
<!--    --><?//= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'total_number') ?>

<!--    <div class="col-xs-3"> --><?//= $form->field($model, 'current_number') ?><!--</div>-->

<!--    --><?//= $form->field($model, 'before_number') ?>
            <div class="col-xs-3">
                <?= $form->field($model, 'account_type')
                    ->dropDownList(\common\models\Types::types_list(['keys'=>1011])); ?>
            </div>
            <div class="col-xs-3">
                <?= $form->field($model, 'account_category')
                    ->dropDownList(\common\models\Types::types_list(['keys'=>1012])); ?>
            </div>

<!--    --><?//= $form->field($model, 'account_type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'account_category') ?>

    <?php // echo $form->field($model, 'operation_time') ?>
            <div class="col-xs-3">
    <?php  echo $form->field($model, 'name') ?>
            </div>
    <?php // echo $form->field($model, 'account_card') ?>
            <div class="col-xs-3">
    <?php  echo $form->field($model, 'content') ?>
            </div>
    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'ext1') ?>

    <?php // echo $form->field($model, 'ext2') ?>

    <?php // echo $form->field($model, 'add_user') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'create_at') ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
