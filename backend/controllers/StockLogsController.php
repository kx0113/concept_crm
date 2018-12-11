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

        $model=new StockLogs();
        //备注
        $remark = Yii::$app->request->post('remark','');
        //产品id
        $stock_id = Yii::$app->request->post('stock_id','');
        //时间
        $operation_time = Yii::$app->request->post('operation_time','');
        //数量
        $current_number = Yii::$app->request->post('current_number','');
        //1=入库; 2=出库
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
        $number_action='';
        if($status==1){
            $number_action='plus';
        }
        if($status==2){
            //客户
            $customer_id = Yii::$app->request->post('customer_id',0);
            //用途
            $purpose_id = Yii::$app->request->post('purpose_id',0);
            if(empty($customer_id)){
                $this->ReturnJson(0,'请选择客户');
            }
            if(empty($purpose_id)){
                $this->ReturnJson(0,'请选择用途');
            }
            $number_action='reduce';
        }
        $transaction = Stock::getDb()->beginTransaction();
        try {
            $model->before_number=Stock::get_total_number($stock_id);
            if($status==2){
                $model->customer_id=Yii::$app->request->post('customer_id');
                $model->purpose_id=Yii::$app->request->post('purpose_id');
            }
            $update_total_number=Stock::update_total_number($stock_id,$current_number,$number_action);
            $model->status=$status;
            $model->remark=$remark;
            $model->operation_time=$operation_time;
            $model->current_number=$current_number;
            $model->total_number=Stock::get_total_number($stock_id);
            $model->add_user=yii::$app->user->identity->id;
            $model->stock_id=$stock_id;
            $model->create_at=date("Y-m-d H:i:s");
            $model->update_at=date("Y-m-d H:i:s");
            if($update_total_number===true){
                $res=$model->save();
                if($res){
                    $transaction->commit();
                    $this->ReturnJson(1,'操作成功',$res);
                }else{
                    $transaction->rollBack();
                }
            }elseif($update_total_number=='insufficient'){
                $transaction->rollBack();
                $this->ReturnJson(0,'数量不足');
            }
        } catch(\Exception $e) {
            $transaction->rollBack();
            $this->ReturnJson(0,'操作失败');
        }
        $this->ReturnJson(0,'操作失败');
    }

    public function actionReturns(){
        return $this->render('returns', [
        ]);
    }


}
