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
class Site5Controller extends Controller
{
    public $session_web_id;
    public $index_product_limit;
    public $product_parent;
    public $product_limit;
    public $news_type;
    public $news_index_limit;
    public $news_title;
    public $news2_title;
    public $news_limit;
    public $product_title;
    public $news_title_eng;
    public $product_title_eng;
    public $news2_type;

    public function init(){
        parent::init();
        $this->product_parent=Yii::$app->params['web6']['product_parent'];
        $this->index_product_limit=Yii::$app->params['web6']['index_product_limit'];
        $this->product_limit=Yii::$app->params['web6']['product_limit'];
        $this->news_type=Yii::$app->params['web6']['news_type'];
        $this->news_index_limit=Yii::$app->params['web6']['news_index_limit'];
        $this->news_title=Yii::$app->params['web6']['news_title'];
        $this->news2_title=Yii::$app->params['web6']['news2_title'];
        $this->news_limit=Yii::$app->params['web6']['news_limit'];
        $this->product_title=Yii::$app->params['web6']['product_title'];
        $this->news_title_eng=Yii::$app->params['web6']['news_title_eng'];
        $this->product_title_eng=Yii::$app->params['web6']['product_title_eng'];
        $this->news2_type=Yii::$app->params['web6']['news2_type'];

        Yii::$app->session->set('web_id',Yii::$app->params['web6']['web_id']);
        $this->session_web_id=Yii::$app->session->get('web_id');
        $web_in=$this->common_info();
//        var_dump($web_in);
        if($web_in['web_info']['status']!=='1'){
            echo ''.$web_in[1]['webexitmsg'].'';
            exit;
        }
//        echo Yii::getVersion();
        Yii::$app->CommonClass->create_log($this->session_web_id);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * 基础信息
     */
    public function common_info(){
        return Yii::$app->CommonClass->common_data_assemble($this->session_web_id,Yii::$app->params['web6']['product_parent']);
    }
    public function actionTest(){
        echo $this->generate_password(50);
    }
    /**
     * 产品中心
     * @param $type_id 二级分类
     * @return array
     */
    public function actionProduct(){
        $type_id=!empty($_REQUEST['type_id']) ? $_REQUEST['type_id'] : "";
        $data=Yii::$app->CommonClass
            ->product_list($type_id,$this->session_web_id,$this->product_limit,$this->product_parent);
        return $this->render('product',[
            'product'=>$data['res'],
            'page'=>$data['page'],
            'tit'=>$this->product_title,
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 维修案例
     * @param $type_id 二级分类
     * @return array
     */
    public function actionProduct2(){
        $type_id=!empty($_REQUEST['type_id']) ? $_REQUEST['type_id'] : "";
        $data=Yii::$app->CommonClass
            ->product_list($type_id,$this->session_web_id,$this->product_limit,Yii::$app->params['web6']['product2_parent']);
        return $this->render('product',[
            'product'=>$data['res'],
            'page'=>$data['page'],
            'tit'=>Yii::$app->params['web6']['product2_title'],
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 产品中心详情
     * @param $id 产品表主键id
     * @return array(one)
     */
    public function actionProCont(){
        return $this->render('procont',[
            'pro'=>Yii::$app->CommonClass->one_product_find(Yii::$app->request->get('id'),$this->session_web_id),
            'common_info'=>$this->common_info(),
            'tit'=>$this->product_title,
        ]);
    }

    /**
     * 项目
     */
    public function actionIntro(){
        return $this->render('content',[
            'tit'=>$_GET['name'],
            'cont'=>$this->project($_GET['id']),
            'common_info'=>$this->common_info(),
        ]);
    }

    /**
     * 关于我们
     */
    public function actionArticle1(){
        return $this->render('content',[
            'tit'=>Yii::$app->params['web6']['article_title_1'],
            'cont'=>$this->project(Yii::$app->params['web6']['article_1']),
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 联系我们
     */
    public function actionArticle2(){
        return $this->render('content',[
            'tit'=>Yii::$app->params['web6']['article_title_2'],
            'cont'=>$this->project(Yii::$app->params['web6']['article_2']),
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 售后服务
     */
    public function actionArticle3(){
        return $this->render('content',[
            'tit'=>Yii::$app->params['web6']['article_title_3'],
            'cont'=>$this->project(Yii::$app->params['web6']['article_3']),
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 上门维修
     */
    public function actionArticle4(){
        return $this->render('content',[
            'tit'=>Yii::$app->params['web6']['article_title_4'],
            'cont'=>$this->project(Yii::$app->params['web6']['article_4']),
            'common_info'=>$this->common_info(),
        ]);
    }

    /**
     * 项目
     */
    public function project($id){
        return Yii::$app->CommonClass->project($id,$this->session_web_id);
    }
    /**
     * news_列表
     * @param $news_type 新闻分类
     * @return array
     */
    public function news_lists($news_type){
        return Yii::$app->CommonClass->news_list($news_type,$this->session_web_id,$this->news_limit);
    }
    /**
     * 维修知识
     */
    public function actionNews2(){
        $data=$this->news_lists($this->news2_type);
        return $this->render('news',[
            'news'=>$data['res'],
            'page'=>$data['page'],
            'tit'=>$this->news2_title,
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 新闻中心
     * @param 新闻分类
     * @return array
     */
    public function actionNews(){
        $data=$this->news_lists($this->news_type);
        return $this->render('news',[
            'news'=>$data['res'],
            'page'=>$data['page'],
            'tit'=>$this->news_title,
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 新闻详情
     * @param $id 新闻表主键id
     * @return array(one)
     */
    public function actionNewCon(){
        return $this->render('news_con',[
            'news'=>Yii::$app->CommonClass->new_one_find(Yii::$app->request->get('id'),$this->session_web_id),
            'tit'=>$this->news_title,
            'common_info'=>$this->common_info(),
        ]);
    }
    /**
     * 首页
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index',[
            'product'=>Yii::$app->CommonClass
                ->index_product_limit($this->product_parent,$this->session_web_id,$this->index_product_limit),
            'common_info'=>$this->common_info(),
            'news_title'=>$this->news_title,
            'news_title_eng'=>$this->news_title_eng,
            'article_title_1'=>Yii::$app->params['web6']['article_title_1'],
            'article_title_eng_1'=>Yii::$app->params['web6']['article_title_eng_1'],
            'article_title_2'=>Yii::$app->params['web6']['article_title_2'],
            'article_title_4'=>Yii::$app->params['web6']['article_title_4'],
            'product_title_eng'=>$this->product_title_eng,
            'product_title'=>$this->product_title,
            'news'=>Yii::$app->CommonClass->index_news_limit($this->news_type,$this->session_web_id,$this->news_index_limit),
        ]);
    }
}
