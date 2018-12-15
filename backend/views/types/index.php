<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '分类列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-index">

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
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '{items}{summary}{pager}',
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'keys',
                'value'=>
                    function($model){
                        return Yii::$app->params['types_classs'][$model->keys];
                    },
            ],
            [
                'attribute' => 'parent',
                'value'=>
                    function($model){
                         if(!empty($model->parent)){
                             return Yii::$app->params['types_classs'][$model->parent];
                         }else{
                             return '';
                         }
                    },
            ],
            'add_time',
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
                            </div></div></div></div></div></div></div></div>
