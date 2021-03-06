<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Orders */
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

                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'orders_type')->dropDownList(\common\models\Types::types_list(['keys'=>1013])); ?>
                                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'customer_id')
                                    ->dropDownList(\common\models\Customer::getDropDownList()); ?>
<!--                                --><?//= $form->field($model, 'customer_id')->textInput() ?>
<!--                                <div class="form-group field-orders-start_time required">-->
<!--                                    <label class="control-label"-->
<!--                                           for="orders-start_time">开始时间</label>-->
<!--                                    <input class="datetimepicker_html search_input_stock form-control"-->
<!--                                           type="text" value="" data-date-format="yyyy-mm-dd"-->
<!--                                           id="orders-start_time" name="Orders[start_time]" aria-required="true" aria-invalid="true">-->
<!--                                    <div class="help-block"></div>-->
<!--                                </div>-->
                                <?= $form->field($model, 'start_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
                                    'options' => ['placeholder' => ''],
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'todayHighlight' => true,
                                        'todayBtn'=> true,
                                        'minView'=>'month',
                                        'format'=> 'yyyy-mm-dd',
                                        'pickerPosition'=> "bottom-left",
                                        'startDate'=>'',
                                    ]
                                ]); ?>
                                <?= $form->field($model, 'end_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
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

<!--                                --><?//= $form->field($model, 'start_time')->textInput() ?>

<!--                                --><?//= $form->field($model, 'end_time')->textInput() ?>

                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($model, 'sale_cost')->textInput() ?>
                                <?= $form->field($model, 'work_cost')->textInput() ?>

                                <?= $form->field($model, 'freight_cost')->textInput() ?>
                                <?= $form->field($model, 'other_cost')->textInput() ?>

                                <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

                                <!--    --><? //= $form->field($model, 'status')->textInput() ?>

                                <!--    --><? //= $form->field($model, 'token')->textInput() ?>

                                <!--    --><? //= $form->field($model, 'add_user')->textInput() ?>

                                <!--    --><? //= $form->field($model, 'update_at')->textInput() ?>

                                <!--    --><? //= $form->field($model, 'create_at')->textInput() ?>

                                <div class="form-group">
                                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '创建') : Yii::t('app', '更新'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>