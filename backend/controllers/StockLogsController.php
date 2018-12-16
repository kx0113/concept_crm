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
        $queryParams=Yii::$app->request->queryParams;
        $stock_id=Yii::$app->request->post('StockLogsSearch[stock_id]','');
        if(!empty($stock_id)){
            $queryParams['StockLogsSearch']['stock_id']=$stock_id;
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
            $model->add_user=yii::$app->user->identity->id;
            $model->create_at=date("Y-m-d H:i:s");
            $model->token=Yii::$app->session->get('web_id');
            if($model->save()){
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
        $operation_time = Yii::$app->request->post('operation_time',date('Y-m-d'));
        //数量
        $current_number = Yii::$app->request->post('current_number','');
        //1=入库; 2=出库
        $status = Yii::$app->request->post('status','');
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
        if($status==1){
            $number_action='plus';
        }
        if($status==2){
            //客户
            $customer_id = Yii::$app->request->post('customer_id',0);
            //用途
            $purpose_id = Yii::$app->request->post('purpose_id',0);
            $orders_id = Yii::$app->request->post('orders_id',0);
            if(empty($customer_id)){
                $this->ReturnJson(0,'请选择客户');
            }
            if(empty($purpose_id)){
                $this->ReturnJson(0,'请选择用途');
            }
            if(empty($orders_id) || $orders_id==0){
                $this->ReturnJson(0,'订单不能为空');
            }
            $number_action='reduce';
        }
        $transaction = Stock::getDb()->beginTransaction();
        try {
            $model->before_number=Stock::get_total_number($stock_id);
            if($status==2){
                $model->customer_id=Yii::$app->request->post('customer_id');
                $model->purpose_id=Yii::$app->request->post('purpose_id');
                $model->orders_id=Yii::$app->request->post('orders_id',0);
            }
            $update_total_number=Stock::update_total_number($stock_id,$current_number,$number_action);

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

    public function actionReturns(){
        return $this->render('returns', [
        ]);
    }
}
