<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Types */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="types-form">
    <div class="col-xs-6 col-xs-offset-3">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?php //var_dump($type_list);  exit; ?>
<!--    --><?//= $form->field($model, 'keys')->textInput() ?>
    <?= $form->field($model, 'keys')->dropDownList($type_list); ?>
<!--    --><?//= $form->field($model, 'parent')->textInput() ?>
    <?= $form->field($model, 'parent')->dropDownList($type_list); ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'add_time')->textInput() ?>

<!--    --><?//= $form->field($model, 'add_user')->textInput() ?>

<!--    --><?//= $form->field($model, 'token')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
