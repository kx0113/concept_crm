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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'stock_id') ?>

    <?= $form->field($model, 'total_number') ?>

    <?= $form->field($model, 'current_number') ?>

    <?= $form->field($model, 'before_number') ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
