<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\StockLogs;
use common\models\Types;
use common\models\StockSearch;
use common\models\Orders;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use moonland\phpexcel\Excel;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends BaseController
{
    public function init(){
        parent::init();
    }
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
    public function test22View($info){
        return $this->render('test21', ['info'=>$info]);
    }
    public function actionTest21(){
        $email_title = Yii::$app->request->post('email_title','');
        $html = Yii::$app->request->post('html','');
        $mail= Yii::$app->mailer->compose();
        $mail->setTo(['xushenkai99@126.com','uptostar@163.com']); //要发送给那个人的邮箱
        $mail->setSubject($email_title.date("Y-m-d")); //邮件主题
        $mail->setHtmlBody($html); //发送的消息内容
        $send_mail=$mail->send();
        if($send_mail){
            return $this->ReturnJson(1,'邮件发送成功',$send_mail);
        }
        return $this->ReturnJson(0,'邮件发送失败','');
//        return $this->test22View('订单创建');
    }
    public function actionOutExcel(){
        ini_set("memory_limit", "256M");
        set_time_limit(0);
        $id = Yii::$app->request->get('id','');
        $name = Yii::$app->request->get('name','');
        $objectPHPExcel = new \PHPExcel();
        $data=Orders::orders_view($id);
//        echo json_encode($data);exit;
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('A1', '序号');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('B1', '产品名称');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('C1', '编号');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('D1', '品牌分类');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('E1', '规格');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('F1', '物品分类');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('G1', '单位');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('H1', '零售价');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('I1', '成本价');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('J1', '出库次数');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('K1', '实际数量');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('L1', '归还数量');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('M1', '总用数量');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('N1', '零售总价');
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('O1', '成本总价');
        $n = 2;
        $key = 1;
        if(!empty($data['stock_logs'])){
            foreach ($data['stock_logs'] as $k=>$v){
                $objectPHPExcel->getActiveSheet()->setCellValue('A'.($n) ,$key++);
                $objectPHPExcel->getActiveSheet()->setCellValue('B'.($n) ,$v['name']);
                $objectPHPExcel->getActiveSheet()->setCellValue('C'.($n) ,$v['number']);
                $objectPHPExcel->getActiveSheet()->setCellValue('D'.($n) ,Types::getName($v['brand']));
                $objectPHPExcel->getActiveSheet()->setCellValue('E'.($n) ,Types::getName($v['size']));
                $objectPHPExcel->getActiveSheet()->setCellValue('F'.($n) ,Types::getName($v['goods_type']));
                $objectPHPExcel->getActiveSheet()->setCellValue('G'.($n) ,Types::getName($v['company']));
                $objectPHPExcel->getActiveSheet()->setCellValue('H'.($n) ,$v['market_price']);
                $objectPHPExcel->getActiveSheet()->setCellValue('I'.($n) ,$v['purchase_price']);
                $objectPHPExcel->getActiveSheet()->setCellValue('J'.($n) ,$v['list_count']);
                $objectPHPExcel->getActiveSheet()->setCellValue('K'.($n) ,$v['current_number']);
                $objectPHPExcel->getActiveSheet()->setCellValue('L'.($n) ,0);
                $objectPHPExcel->getActiveSheet()->setCellValue('M'.($n) ,$v['current_number']);
                $objectPHPExcel->getActiveSheet()->setCellValue('N'.($n) ,$v['row_market_price']);
                $objectPHPExcel->getActiveSheet()->setCellValue('O'.($n) ,$v['row_purchase_price']);
                $n = $n +1;
            }
        }

        ob_end_clean();
        ob_start();
        header('Content-Type : application/vnd.ms-excel');
        //设置输出文件名及格式
        header('Content-Disposition:attachment;filename="'.$name.'-'.date("Ymd").'-'.rand(1111,9999).'.xls"');
        //导出.xls格式的话使用Excel5,若是想导出.xlsx需要使用Excel2007
        $objWriter= \PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
        $objWriter->save('php://output');
        ob_end_flush();
        //清空数据缓存
        unset($data);
    }
    public function actionTest23(){
        return $this->test22View('财务统计');
    }
    public function actionTest24(){
        return $this->test22View('订单统计');
    }
    public function actionTest25(){
        return $this->test22View('客户统计');
    }
    public function actionTest26(){
        return $this->test22View('入库统计');
    }
    public function actionTest27(){
        return $this->test22View('出库统计');
    }
    public function actionCustomerOrderList(){
        $customer_id = Yii::$app->request->post('customer_id','');
        if(empty($customer_id)){
            $this->ReturnJson(0,'请选择客户');
        }
        return $this->ReturnJson(1,'OK',Orders::findCustomerOrderList($customer_id));
    }
    public function actionGetStockInfo(){
        return $this->ReturnJson(1,'OK',Stock::getLists());
//        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        echo json_encode(['list'=>Stock::getLists()]);exit;
    }
    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $queryParams=Yii::$app->request->queryParams;
//        echo json_encode(Yii::$app->request->queryParams);
        $searchModel = new StockSearch();

        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
//            'post_data'=>isset($queryParams['StockSearch']) ? $queryParams['StockSearch'] : '',
        ]);
    }
    public function actionLogs($id){
        $this->redirect(['/stock-logs/index','StockLogsSearch[stock_id]'=>$id]);

        $res=StockLogs::find()->where(['stock_id'=>$id])->asArray()->all();
        return $this->render('logs', [
            'model' => $this->findModel($id),
            'stock_logs' => $res,
        ]);
    }
    /**
     * Displays a single Stock model.
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
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        var_dump(Types::types_list(['keys'=>1001]));exit;
        $model = new Stock();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->add_user=yii::$app->user->identity->id;
            $model->update_at=date("Y-m-d H:i:s");
            $model->create_at=date("Y-m-d H:i:s");
            $model->token=Yii::$app->session->get('web_id');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stock model.
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
     * Finds the Stock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Stock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
