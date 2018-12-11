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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'token') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'size') ?>

    <?= $form->field($model, 'goods_type') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'ext1') ?>

    <?php // echo $form->field($model, 'ext2') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'add_user') ?>

    <?php // echo $form->field($model, 'upate_at') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
