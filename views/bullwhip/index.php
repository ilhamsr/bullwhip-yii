<?php

use app\models\Barang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BarangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Barangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Barang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="container-fluid">
	<div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th> </th>
                        <th> Nama Barang </th>
                        <th> Deviasi Pesanan </th>
                        <th> Mean Pesanan </th>
                        <th> Deviasi Produksi </th>
                        <th> Mean Produksi </th>
                        <th> Lead Time </th>
                        <th> BE </th>
                        <th> Parameter </th>
                        <th> Bullwhip Effect </th>

                    </tr>
                    <tr>
                    <?php

                        foreach ($dataProvider as $key => $data) {
                    ?>
                        <td> <?php echo $key+1 ?> </td>
                        <td> <?php echo $data["nama_barang"] ?> </td>
                        <td> <?php echo $data["s_order"] ?> </td>
                        <td> <?php echo $data["mean_order"] ?> </td>
                        <td> <?php echo $data["s_demand"] ?> </td>
                        <td> <?php echo $data["mean_demand"] ?> </td>
                        <td> <?php echo $data["lead_time"] ?> </td>
                        <td> <?php echo $data["BE"] ?> </td>
                        <td> <?php echo $data['parameter'] ?> </td>
                        <td> <?php if (($data['BE']) > ($data['parameter']))
								{
															echo '<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">
							<span class="glyphicon glyphicon-thumbs-up">
							  Solusi Bullwhip
							</span>
						</button>';
								}
								else
								{
									echo "Tidak Terjadi Bullwhip Effect";
								}

							?>



                        </tr>
                        <?php
                        }
                    ?>
                </table>
            </div>
        </div>
	</div>
</div>


</div>
