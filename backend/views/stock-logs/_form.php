<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stock_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'before_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'purpose_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operation_time')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
