<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Selamat Datang di aplikasi Bullwhip
        </h1>

        
    </div>

    <div class="body-content text-center">
        <?php
        echo Yii::$app->user->isGuest
            ? '
            <p class="lead">Silakan login untuk menggunakan aplikasi</p>
    
            <p><a class="btn btn-lg btn-success" href="http://localhost:8080/index.php?r=site/login">Login</a></p>   '
            : 'Silakan pilih menu yang tersedia'
        ?>

    </div>
</div>
