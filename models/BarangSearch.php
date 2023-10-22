<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Barang;
use Yii;
use yii\db\Query;

/**
 * BarangSearch represents the model behind the search form of `app\models\Barang`.
 */
class BarangSearch extends Barang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang'], 'integer'],
            [['nama_barang'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Barang::find();

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
            'id_barang' => $this->id_barang,
        ]);

        $query->andFilterWhere(['like', 'nama_barang', $this->nama_barang]);

        return $dataProvider;
    }

    public function BE()
    {
        $query = new Query;
        $command = $query->createCommand();
        $command->sql = 'SELECT
        barang.nama_barang,
        ROUND(STDDEV(jumlah_pesanan), 3) AS s_order,
        ROUND(
            AVG(pemesanan.jumlah_pesanan),
            3
        ) AS mean_order,
        ROUND(STDDEV(jumlah_produksi), 3) AS s_demand,
        ROUND(
            AVG(produksi.jumlah_produksi),
            3
        ) AS mean_demand,
        ROUND(
            (
                STDDEV(jumlah_pesanan) / AVG(jumlah_pesanan)
            ),
            3
        ) AS cv_order,
        ROUND(
            (
                STDDEV(jumlah_produksi) / AVG(jumlah_produksi)
            ),
            3
        ) AS cv_demand,
        ROUND(
            (
                (
                    STDDEV(jumlah_pesanan) / AVG(jumlah_pesanan)
                ) / (
                    STDDEV(jumlah_produksi) / AVG(jumlah_produksi)
                )
            ),
            3
        ) AS BE,
        produksi.lead_time,
        ROUND(
            (
                1 + ((2 * produksi.lead_time) / 30) + (
                    (2 * produksi.lead_time ^ 2) / (30 ^ 2)
                )
            ),
            3
        ) AS parameter,
        ROUND(
            (
                (
                    STDDEV(jumlah_pesanan) / AVG(jumlah_pesanan)
                ) / (
                    STDDEV(jumlah_produksi) / AVG(jumlah_produksi)
                )
            ) > 1 + ((2 * produksi.lead_time) / 30) + (
                (2 * produksi.lead_time ^ 2) / (30 ^ 2)
            ),
            3
        ) AS Bullwhip_Effect
        FROM
            barang
        INNER JOIN pemesanan ON pemesanan.id_barang = barang.id_barang
        INNER JOIN produksi ON produksi.id_barang = pemesanan.id_barang
        GROUP BY
            barang.nama_barang, produksi.lead_time';
        $result = $command->queryAll();

       
        return $result;
    }

    // public function stock()
    // {
    //     $query = new Query;
    //     $command = $query->createCommand();
    //     $command->sql = '';
    //     $result = $command->queryAll();

       
    //     return $result;
    // }
}
