<?php

namespace app\models\admin\search;

use app\models\Order;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    const SCENARIO_SEARCH = 'search';

    public function rules()
    {
        return [
            [['price'], 'safe']
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_SEARCH => ['price']
        ];
    }

    public function search($params)
    {
        $this->load($params);

        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['price' => $this->price]);

        return $dataProvider;
    }
}