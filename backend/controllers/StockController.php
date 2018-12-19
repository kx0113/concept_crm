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
    public function actionSendMail(){
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

        $data_total=[
            ['merge_cells'=>'A3:D4','field'=>'A3','name'=>'客户姓名：'.$data['customer_info']['name'],],
            ['merge_cells'=>'E3:H4','field'=>'E3','name'=>'联系电话：'.$data['info']['phone'],],
            ['merge_cells'=>'I3:L4','field'=>'I3','name'=>'项目地址：'.$data['info']['address'],],
            ['merge_cells'=>'M3:O4','field'=>'M3','name'=>'合同日期：'.date("Y-m-d",strtotime($data['info']['start_time'])),],
            ['merge_cells'=>'A5:D6','field'=>'A5','name'=>'销售款项：'.$data['info']['sale_cost'],],
            ['merge_cells'=>'E5:H6','field'=>'E5','name'=>'销售利润：'.$data['stock_sum']['total_profit_price'],],
            ['merge_cells'=>'I5:L6','field'=>'I5','name'=>'运费：'.$data['info']['freight_cost'],],
            ['merge_cells'=>'M5:O6','field'=>'M5','name'=>'施工费：'.$data['info']['work_cost'],],
            ['merge_cells'=>'A7:D8','field'=>'A7','name'=>'成本总价：'.$data['stock_sum']['total_purchase_price'],],
            ['merge_cells'=>'E7:H8','field'=>'E7','name'=>'零售总价：'.$data['stock_sum']['total_market_price'],],
            ['merge_cells'=>'I7:L8','field'=>'I7','name'=>'其他费用：'.$data['info']['other_cost'],],
            ['merge_cells'=>'M7:O8','field'=>'M7','name'=>'创建时间：'.$data['info']['create_at'],],
        ];
        $cell_list=[
            ['cell'=>'A','name'=>'序号','width'=>'5','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'B','name'=>'产品名称','width'=>'15','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'C','name'=>'编号','width'=>'15','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'D','name'=>'品牌分类','width'=>'8','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'E','name'=>'规格','width'=>'8','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'F','name'=>'物品分类','width'=>'15','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'G','name'=>'单位','width'=>'8','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'H','name'=>'零售价','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'I','name'=>'成本价','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'J','name'=>'出库次数','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'K','name'=>'实际数量','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'L','name'=>'归还数量','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'M','name'=>'总用数量','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'N','name'=>'零售总价','width'=>'10','height'=>'','font'=>'','bold'=>true],
            ['cell'=>'O','name'=>'成本总价','width'=>'10','height'=>'','font'=>'','bold'=>true],
        ];

        #设置高度
//        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        #标题
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:O2');
        #设置值
        $objectPHPExcel->setActiveSheetIndex()->setCellValue('A1', $name);
        #设置字体
        $objectPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        #字体加粗
        $objectPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        #文字居中
        $objectPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
            ->setHorizontal(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        foreach ($data_total as $k24=>$v24){
            $objectPHPExcel->getActiveSheet()->mergeCells($v24['merge_cells']);
            $objectPHPExcel->setActiveSheetIndex()->setCellValue($v24['field'], $v24['name']);
            #设置水平居中
            $objectPHPExcel->getActiveSheet()->getStyle($v24['field'])->getAlignment()
                ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            #设置垂直居中
            $objectPHPExcel->getActiveSheet()->getStyle($v24['field'])->getAlignment()
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }

        #设置标题
        $title_num=9;
        foreach ($cell_list as $k=>$v){
            $objectPHPExcel->getActiveSheet()->getStyle($v['cell'].($title_num))->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $objectPHPExcel->getActiveSheet()->getStyle($v['cell'].($title_num))->getFill()->getStartColor()->setARGB('f2a679');
                #宽度
                $objectPHPExcel->getActiveSheet()->getColumnDimension($v['cell'])->setWidth($v['width']);
                #高度
                $objectPHPExcel->getActiveSheet()->getRowDimension($title_num)->setRowHeight(30);
                #设置水平居中
                $objectPHPExcel->getActiveSheet()->getStyle($v['cell'].($title_num))->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                #设置垂直居中
                $objectPHPExcel->getActiveSheet()->getStyle($v['cell'].($title_num))->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objectPHPExcel->setActiveSheetIndex()->setCellValue($v['cell'].($title_num), $v['name']);

        }
        #Excel行数
        $n = 10;
        #序号
        $key = 1;
        if(!empty($data['stock_logs'])){
            foreach ($data['stock_logs'] as $k=>$v){
                foreach ($cell_list as $k222=>$v222){
                    #宽度
                    $objectPHPExcel->getActiveSheet()->getColumnDimension($v222['cell'])->setWidth($v222['width']);
                    #高度
                    $objectPHPExcel->getActiveSheet()->getRowDimension($n)->setRowHeight(30);
                    #设置水平居中
                    $objectPHPExcel->getActiveSheet()->getStyle($v222['cell'].($n))->getAlignment()
                        ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    #设置垂直居中
                    $objectPHPExcel->getActiveSheet()->getStyle($v222['cell'].($n))->getAlignment()
                        ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $objectPHPExcel->setActiveSheetIndex()->setCellValue($v222['cell'].($n), $v222['name']);
                }
                $objectPHPExcel->getActiveSheet()->setCellValue('A'.($n) ,$key++);
                $objectPHPExcel->getActiveSheet()->setCellValue('B'.($n) ,$v['name']);
                $objectPHPExcel->getActiveSheet()->setCellValue('C'.($n) ,$v['number'],\PHPExcel_Cell_DataType::TYPE_STRING);
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
        $outputFileName = $name.'-' . date('Ymd').'-'.rand(1111,9999) . '.xls';
        $xlsWriter = new \PHPExcel_Writer_Excel5($objectPHPExcel);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="' . $outputFileName . '"');
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $xlsWriter->save("php://output");
        echo file_get_contents($outputFileName);
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
