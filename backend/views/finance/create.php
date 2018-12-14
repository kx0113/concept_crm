<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Finance */

$this->title = Yii::t('app', 'Create Finance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finance-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
