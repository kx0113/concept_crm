<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $model common\models\Finance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper wrapper-content">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <p>
                <?= Html::encode($this->title) ?>
            </p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="col-xs-6 col-xs-offset-3">
    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'total_number')->textInput(['maxlength' => true]) ?>
<!--    --><?//= $form->field($model, 'account_type')->textInput() ?>
        <?= $form->field($model, 'account_type')->dropDownList(Types::types_list(['keys'=>1011])); ?>
        <?= $form->field($model, 'account_category')->dropDownList(Types::types_list(['keys'=>1012])); ?>
<!--    --><?//= $form->field($model, 'account_category')->textInput() ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_number')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'before_number')->textInput(['maxlength' => true]) ?>


<!--    --><?//= $form->field($model, 'status')->textInput() ?>


<!--    --><?//= $form->field($model, 'operation_time')->textInput() ?>

                                <?= $form->field($model, 'operation_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'todayHighlight' => true,
                                        'todayBtn'=> true,
                                        'minView'=>'month',
                                        'format'=> 'yyyy-mm-dd',
                                        'pickerPosition'=> "bottom-left",
                                    ]
                                ]); ?>
    <?= $form->field($model, 'account_card')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'ext1')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'ext2')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'add_user')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'token')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '创建') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

                            </div></div></div></div></div></div></div></div>

