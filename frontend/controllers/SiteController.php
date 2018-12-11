<?php
namespace frontend\controllers;

//use Faker\Provider\zh_CN\Company;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\FrontMenu;
use common\models\WebCommon;
use common\models\Product;
use common\models\News;
use common\models\ProductType;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use common\models\Company;
use common\models\FrontLog;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function init(){
        parent::init();
    }
    /**
     * 首页
     * @return mixed
     */
    public function actionIndex()
    {
        var_dump(1);
        return $this->render('index',[]);
    }
}
