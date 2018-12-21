<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%finance}}".
 *
 * @property string $id
 * @property string $total_number
 * @property string $current_number
 * @property string $before_number
 * @property integer $account_type
 * @property integer $status
 * @property integer $account_category
 * @property string $operation_time
 * @property string $name
 * @property string $account_card
 * @property string $content
 * @property string $remark
 * @property string $ext1
 * @property string $ext2
 * @property string $add_user
 * @property integer $token
 * @property string $update_at
 * @property string $create_at
 */
class Finance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%finance}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','current_number','account_type','account_category','operation_time','content'], 'required'],
            [[ 'account_type', 'status', 'account_category', 'add_user', 'token'], 'integer'],
            [['total_number', 'current_number', 'before_number','operation_time', 'update_at', 'create_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['account_card'], 'string', 'max' => 100],
            [['content', 'remark', 'ext1', 'ext2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'total_number' => Yii::t('app', '操作后金额'),
            'current_number' => Yii::t('app', '当前操作金额'),
            'before_number' => Yii::t('app', '操作前金额'),
            'account_type' => Yii::t('app', '账务类型'),
            'status' => Yii::t('app', '状态'),
            'account_category' => Yii::t('app', '账户类别'),
            'operation_time' => Yii::t('app', '操作时间'),
            'name' => Yii::t('app', '姓名'),
            'account_card' => Yii::t('app', '银行卡账号'),
            'content' => Yii::t('app', '用途'),
            'remark' => Yii::t('app', '备注'),
            'ext1' => Yii::t('app', 'Ext1'),
            'ext2' => Yii::t('app', 'Ext2'),
            'add_user' => Yii::t('app', '操作用户'),
            'token' => Yii::t('app', '公司名称'),
            'update_at' => Yii::t('app', '更新时间'),
            'create_at' => Yii::t('app', '创建时间'),
        ];
    }
    public static function AccountCategoryDropDownList(){
        return [
            ''=>'-- 请选择 --',
            '1'=>'对公账户',
            '2'=>'个人账户',
        ];
    }
    public static function AccountTypeDropDownList(){
        return [
            ''=>'-- 请选择 --',
            '1'=>'入账',
            '2'=>'出账',
        ];
    }

    public static function get_account_category($v){
        if($v==1){
            return '对公账户';
        }
        if($v==2){
            return '个人账户';
        }
        return '';
    }
    public static function get_account_type($v){
        if($v==1){
            return '入账';
        }
        if($v==2){
            return '出账';
        }
        return '';
    }
    public static function get_before_number($account_category){
        $input_number=0;
        $res= Finance::find()
            ->where(['account_type'=>1])
            ->andWhere(['token'=>Yii::$app->session->get('web_id')])
            ->andWhere(['account_category'=>$account_category])
            ->andWhere(['account_type'=>1])
            ->asArray()->all();
        if(!empty($res)){
            foreach($res as $k=>$v){
                if($v['account_type']==1){
                    $input_number=bcadd($input_number,$v['current_number'],2);
                }
            }
        }
        return $input_number;
    }
}
