<?php

namespace common\models;

use think\log\driver\Socket;
use Yii;
use common\models\Types;

/**
 * This is the model class for table "kx_stock".
 *
 * @property string $id
 * @property integer $number
 * @property integer $token
 * @property string $name
 * @property integer $brand
 * @property integer $size
 * @property integer $goods_type
 * @property integer $company
 * @property string $remark
 * @property string $ext1
 * @property string $ext2
 * @property integer $status
 * @property integer $add_user
 * @property string $update_at
 * @property string $create_at
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%stock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand','token', 'size', 'goods_type', 'company', 'status', 'add_user'], 'integer'],
            [['update_at', 'create_at'], 'safe'],
            [['name', 'remark', 'ext1', 'ext2'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'number' => '编号',
            'token' => '公司名称',
            'name' => '产品名称',
            'brand' => '品牌分类',
            'size' => '规格',
            'goods_type' => '物品分类',
            'company' => '单位',
            'remark' => '备注',
            'ext1' => 'Ext1',
            'ext2' => 'Ext2',
            'status' => '状态',
            'add_user' => '创建用户',
            'update_at' => '更新时间',
            'create_at' => '创建时间',
        ];
    }
    public static function getLists($where=[]){
        $res= Stock::find()->where($where)->asArray()->all();
        if(!empty($res)){
            foreach($res as $k=>$v){
                $res[$k]['size']=Types::getName($v['size']);
                $res[$k]['goods_type']=Types::getName($v['goods_type']);
                $res[$k]['brand']=Types::getName($v['brand']);
                $res[$k]['company']=Types::getName($v['company']);
//                $res[$k]['total_number']=1000;
            }
        }
        return $res;
    }
    public static function get_total_number($id){
        $res=Stock::findOne($id);
        if(!empty($res->total_number)){
            return $res->total_number;
        }
        return '';
    }
    public static function update_total_number($id,$number,$action){
        if(empty($action)){
            return false;
        }
        $update=Stock::findOne($id);
        if($action=='plus'){
            $update->total_number=bcadd($update->total_number,$number);
        }
        if($action=='reduce'){
            $total_number=bcsub($update->total_number,$number);

            if($total_number >= 0){
//                var_dump($total_number,2);exit;
                $update->total_number=$total_number;
            }else{
//                var_dump($total_number,3);exit;
                return 'insufficient';
            }
        }
        $res=$update->save();
        if($res){
            return true;
        }
        return false;
    }
    public static function dddd(){
        $customer = Customer::findOne(123);
        $transaction = Customer::getDb()->beginTransaction();
        try {
            $customer->id = 200;
            $customer->save();
            // ...other DB operations...
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
