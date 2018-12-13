<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StockLogs */

$this->title = Yii::t('app', 'Create Stock Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stock Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
