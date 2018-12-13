<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StockLogs;

/**
 * StockLogsSearch represents the model behind the search form about `common\models\StockLogs`.
 */
class StockLogsSearch extends StockLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stock_id', 'total_number', 'current_number', 'before_number', 'customer_id', 'purpose_id', 'is_returns', 'status', 'token', 'add_user'], 'integer'],
            [['remark', 'operation_time', 'update_at', 'create_at'], 'safe'],
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
//        $query = StockLogs::find();
        $query = StockLogs::find()->where(['token'=>Yii::$app->session->get('web_id')]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'stock_id' => $this->stock_id,
            'total_number' => $this->total_number,
            'current_number' => $this->current_number,
            'before_number' => $this->before_number,
            'customer_id' => $this->customer_id,
            'purpose_id' => $this->purpose_id,
            'is_returns' => $this->is_returns,
            'status' => $this->status,
            'token' => $this->token,
            'add_user' => $this->add_user,
            'operation_time' => $this->operation_time,
            'update_at' => $this->update_at,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
