<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">

    <div class="wrapper wrapper-content">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <p>
                    <?= Html::encode('查看：'.$this->title) ?>
                </p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">

                                <p>
                                    <?= Html::a(Yii::t('app', '更新'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>

                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        'number',
                                        'name',
                                        'purchase_price',
                                        'market_price',
                                        [
                                            'attribute' => 'brand',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(common\models\Types::getName($searchModel->brand), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'size',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(common\models\Types::getName($searchModel->size), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'goods_type',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(common\models\Types::getName($searchModel->goods_type), 0, 10, 'utf-8');
                                                },
                                        ],
                                        [
                                            'attribute' => 'company',
                                            'value' =>
                                                function ($searchModel) {
                                                    return mb_substr(common\models\Types::getName($searchModel->company), 0, 10, 'utf-8');
                                                },
                                        ],
                                        'remark',
                                        'ext1',
                                        'ext2',
                                        'status',
                                        [
                                            'attribute' => 'add_user',
                                            'value'=>
                                                function($model){
                                                    return \common\models\User::get_username($model->add_user);
                                                },
                                        ],
                                        [
                                            'attribute' => 'token',
                                            'value'=>
                                                function($model){
                                                    return \common\models\Web::GetWebName($model->token);
                                                },
                                        ],
                                        'update_at',
                                        'create_at',
                                    ],
                                ]) ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
