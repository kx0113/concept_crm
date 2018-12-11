<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\Types;
use common\models\StockLogs;
use common\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StockLogsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionInputs(){
        return $this->render('inputs', [
        ]);
    }
    public function actionOuts(){
        return $this->render('outs', [
        ]);
    }

    /**
     * @desc 入库出库操作
     */
    public function actionAddStockLogs(){
        Stock::update_total_number(7,1,'reduce');
        $model=new StockLogs();
        $remark = Yii::$app->request->post('remark','');
        $stock_id = Yii::$app->request->post('stock_id','');
        $operation_time = Yii::$app->request->post('operation_time','');
        $current_number = Yii::$app->request->post('current_number','');
        $customer_id = Yii::$app->request->post('customer_id',0);
        $purpose_id = Yii::$app->request->post('purpose_id',0);
        $status = Yii::$app->request->post('status','');
        if(empty($stock_id) || $stock_id==0){
            $this->ReturnJson(0,'请选择产品');
        }
        if(empty($current_number)){
            $this->ReturnJson(0,'请选择数量');
        }
        if(empty($operation_time)){
            $this->ReturnJson(0,'请选择时间');
        }

        if($status==1){

        }
        if($status==2){
            if(empty($customer_id)){
                $this->ReturnJson(0,'请选择客户');
            }
            if(empty($purpose_id)){
                $this->ReturnJson(0,'请选择用途');
            }
            $model->customer_id=$customer_id;
            $model->purpose_id=$purpose_id;
        }
        if($status==3){

        }
        $model->status=$status;
        $model->remark=$remark;
        $model->operation_time=$operation_time;
        $model->current_number=$current_number;
        $model->add_user=yii::$app->user->identity->id;
        $model->stock_id=$stock_id;
        $model->create_at=date("Y-m-d H:i:s");
        $model->update_at=date("Y-m-d H:i:s");
        $res=$model->save();
        if($res){
            $this->ReturnJson(1,'操作成功',$res);
        }
        $this->ReturnJson(0,'操作失败',$res);
    }

    public function actionReturns(){
        return $this->render('returns', [
        ]);
    }


}
