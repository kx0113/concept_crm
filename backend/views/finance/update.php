<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Finance */

$this->title = Yii::t('app', '更新: ', [
    'modelClass' => 'Finance',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="finance-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
