<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Stock;

/**
 * StockSearch represents the model behind the search form about `common\models\Stock`.
 */
class StockSearch extends Stock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_price', 'market_price','id', 'token', 'size', 'goods_type', 'company', 'status', 'add_user'], 'integer'],
            [['number','name', 'remark', 'ext1', 'ext2', 'update_at', 'create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Stock::find()->where(['token'=>Yii::$app->session->get('web_id')])->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
            'goods_type' => $this->goods_type,
            'company' => $this->company,
            'status' => $this->status,
            'add_user' => $this->add_user,
            'update_at' => $this->update_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'ext1', $this->ext1])
            ->andFilterWhere(['like', 'ext2', $this->ext2]);
        if(isset($params['StockSearch']['start_time'])
            && !empty($params['StockSearch']['start_time'])
            && isset($params['StockSearch']['end_time'])
            && !empty($params['StockSearch']['end_time'])
        ){
            $query->andFilterWhere(['between','create_at',$params['StockSearch']['start_time'] .' 00:00:00', $params['StockSearch']['end_time'].' 23:59:59']);
        }
        return $dataProvider;
    }
}
