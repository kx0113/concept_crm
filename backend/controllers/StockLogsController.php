<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\StockLogs;
use common\models\StockLogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SignalController implements the CRUD actions for StockLogs model.
 */
class StockLogsController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StockLogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;
        $stock_id = Yii::$app->request->post('StockLogsSearch[stock_id]', '');
        if (!empty($stock_id)) {
            $queryParams['StockLogsSearch']['stock_id'] = $stock_id;
        }
        $searchModel = new StockLogsSearch();
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StockLogs model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StockLogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StockLogs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StockLogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->add_user = yii::$app->user->identity->id;
            $model->create_at = date("Y-m-d H:i:s");
            $model->token = Yii::$app->session->get('web_id');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StockLogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StockLogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StockLogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StockLogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInputs()
    {
        return $this->render('inputs', [
        ]);
    }

    /**
     * @desc 通过-产品id-客户id-订单id-查询出库总量
     */
    public function actionFindCustomerNumber()
    {
        $stock_id = Yii::$app->request->post('stock_id', '');
        $customer_id = Yii::$app->request->post('customer_id', '');
        $orders_id = Yii::$app->request->post('orders_id', '');
        if (empty($stock_id) || $stock_id == 0) {
            $this->ReturnJson(0, 'stock_id为空');
        }
        if (empty($customer_id) || $customer_id == 0) {
            $this->ReturnJson(0, 'customer_id为空');
        }
        if (empty($orders_id) || $orders_id == 0) {
            $this->ReturnJson(0, 'orders_id为空');
        }
        #归还数量
        $return_number = 0;
        #出库数量
        $out_number = 0;
        $where['stock_id'] = $stock_id;
        $where['customer_id'] = $customer_id;
        $where['orders_id'] = $orders_id;
//        $where['status']=StockLogs::IS_RETURNS_2;
        $res = StockLogs::get_customer_list($where);
        if (!empty($res)) {
            foreach ($res as $k => $v) {
                if ($v['status'] == 2) {
                    $out_number = bcadd($out_number, $v['current_number'], 0);
                }
                if ($v['is_returns'] == 2) {
                    $return_number = bcadd($return_number, $v['current_number'], 0);
                }
            }
        }
        $out_number = bcsub($out_number, $return_number, 0);
        if ($out_number < 0) {
            $out_number = 0;
        }
        $this->ReturnJson(1, 'OK', ['out_number' => $out_number]);
//        $this->ReturnJson(1,'OK',$res);
    }
    /**
     * @desc 批量入库出库操作
     */
    public function actionAddStockLogs(){
        $outsHandler=[];
        $list = Yii::$app->request->post('list','');
        if(is_array($list) && !empty($list) && count($list) >= 1){
            $transaction = Stock::getDb()->beginTransaction();
            try {
                foreach($list as $k=>$v) {
                    list($code,$msg,$data)=StockLogs::StockLogOptionHandler($v);
                    $outsHandler[]=['code'=>$code,'msg'=>$msg];
                }
//                $this->ReturnJson(1,'操作成功',$outsHandler);
                $res=$this->batchReturnJudge($outsHandler);
                if(empty($res)){
                    $transaction->commit();
                    $this->ReturnJson(1,'操作成功',$res);
                }else{
                    $transaction->rollBack();
                    $this->ReturnJson(0,'操作失败[1]',$outsHandler);
                }

            }catch(\Exception $e) {
                $transaction->rollBack();
                $this->ReturnJson(0,'操作失败[2]',$outsHandler);
            }
        }
        $this->ReturnJson(0,'操作失败[3]',$outsHandler);
    }
    public function batchReturnJudge($data){
        $false='';
        if(empty($data)){
            return false;
        }
        foreach($data as $v){
            if($v['code'] !== 1){
                $false=false;
            }
        }
        return $false;
    }
    /**
     * @desc 入库出库操作
     */
    public function actionAddStockLogs2(){
//        echo StockLogs::IS_RETURNS_2;exit;
        $model=new StockLogs();
        //备注
        $remark = Yii::$app->request->post('remark','');
        //产品id
        $stock_id = Yii::$app->request->post('stock_id','');
        //时间
        $operation_time = Yii::$app->request->post('operation_time',date('Y-m-d'));
        //数量
        $current_number = Yii::$app->request->post('current_number','');
        $is_returns = Yii::$app->request->post('is_returns',1);
        //1=入库; 2=出库
        $status = Yii::$app->request->post('status','');
        //用途
        $purpose_id = Yii::$app->request->post('purpose_id',0);
        if(empty($stock_id) || $stock_id==0){
            $this->ReturnJson(0,'请选择产品');
        }
        if(empty($current_number)){
            $this->ReturnJson(0,'请选择数量');
        }else{
            if($current_number < 0){
                $this->ReturnJson(0,'数量不能小于0');
            }
        }
        if(empty($operation_time)){
            $this->ReturnJson(0,'请选择时间');
        }
        $number_action='';
        //入库操作
        if($status==StockLogs::IS_RETURNS_1){
            $number_action='plus';
        }
        if($status==StockLogs::IS_RETURNS_2 || $is_returns==2){
            //客户
            $customer_id = Yii::$app->request->post('customer_id',0);
            $orders_id = Yii::$app->request->post('orders_id',0);
            if(empty($customer_id)){
                $this->ReturnJson(0,'请选择客户');
            }
            if(empty($orders_id) || $orders_id==0){
                $this->ReturnJson(0,'订单不能为空');
            }
            //出库操作
            if($status==StockLogs::IS_RETURNS_2){
                $number_action='reduce';
            }
            //归还操作
            if($is_returns==2){
                $number_action='plus';
            }
        }
        if(empty($number_action)){
            $this->ReturnJson(0,'操作错误');
        }
        $transaction = Stock::getDb()->beginTransaction();
        try {
            $model->before_number=Stock::get_total_number($stock_id);
            $update_total_number=Stock::update_total_number($stock_id,$current_number,$number_action);
            $model->is_returns=$is_returns;
            $model->customer_id=Yii::$app->request->post('customer_id',0);
            $model->purpose_id=empty($purpose_id) ? 0 : $purpose_id;
            $model->orders_id=Yii::$app->request->post('orders_id',0);
            $model->status=$status;
            $model->remark=$remark;
            $model->operation_time=$operation_time;
            $model->current_number=$current_number;
            $model->total_number=Stock::get_total_number($stock_id);
            $model->token=Yii::$app->session->get('web_id');
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

    /**
     * @desc 归还
     * @return string
     */
    public function actionReturns()
    {
        $stock_id = Yii::$app->request->get('stock_id', '');
        $orders_id = Yii::$app->request->get('orders_id', '');
        $customer_id = Yii::$app->request->get('customer_id', '');
        return $this->render('returns', [
            'stock_id' => $stock_id,
            'orders_id' => $orders_id,
            'customer_id' => $customer_id,
        ]);
    }

    /**
     * @desc 出库
     * @return string
     */
    public function actionOuts()
    {
        $stock_id = Yii::$app->request->get('stock_id', '');
        $orders_id = Yii::$app->request->get('orders_id', '');
        $customer_id = Yii::$app->request->get('customer_id', '');
        return $this->render('outs', [
            'stock_id' => $stock_id,
            'orders_id' => $orders_id,
            'customer_id' => $customer_id,
        ]);
    }

    public function actionBatchOuts()
    {
        return $this->render('batch-outs', [

        ]);
    }

    public function actionBatchReturns()
    {
        return $this->render('batch-returns', [

        ]);
    }

    public function actionBatchInputs()
    {
        return $this->render('batch-inputs', [

        ]);
    }
}
