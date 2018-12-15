<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\StockLogs;
use common\models\Types;
use common\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        return $this->test22View('订单创建');
    }
    public function actionTest22(){
        return $this->test22View('订单列表');
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
