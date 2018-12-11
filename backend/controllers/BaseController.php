<?php

namespace backend\controllers;

use Yii;
use common\models\Stock;
use common\models\Types;
use common\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
/**
 * StockController implements the CRUD actions for Stock model.
 */
class BaseController extends Controller
{
    public function init()
    {
        parent::init();
    }
    public function ReturnJson($code=1,$msg,$data=[]){
        Yii::$app->response->format=Response::FORMAT_JSON;
        $res['data']=$data;
        if($code==1){
            $res['code']=200;
            $res['msg']=empty($msg) ? 'OK' : $msg;
        }else{
            $res['code']=-999999;
            $res['msg']=empty($msg) ? 'ERROR' : $msg;
        }
        echo json_encode($res);
        exit;
    }

}