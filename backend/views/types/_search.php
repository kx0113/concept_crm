<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TypesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="types-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">


        <div class="col-xs-6">
    <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-xs-6">
    <?= $form->field($model, 'keys')->dropDownList(Yii::$app->params['types_classs']); ?>
        </div>



    <?php // echo $form->field($model, 'add_time') ?>

    <?php // echo $form->field($model, 'add_user') ?>

    <?php // echo $form->field($model, 'token') ?>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
