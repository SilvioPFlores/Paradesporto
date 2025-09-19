<?php
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
include 'config/config.php';
include 'includes/head.php';
getHead('Accessercise', $lang, '', 'css/css-home.css');
include 'includes/menu.php';
menu('ACCESSERCISE');

?>
<div class="container my-5">
    <div class="row align-items-center">
        <!-- Coluna com a imagem do celular -->
        <div class="col-12 col-md-4 text-center mb-4 mb-md-0">
            <img src="img/home/accessercise-mao.png" class="img-fluid" alt="Accessercise App">
        </div>

        <!-- Coluna com QR, link e textos -->
        <div class="col-12 col-md-8 text-center">
            <img src="img/home/accessQr.png" style="width:150px;" alt="QR Code">
            <div class="divAccess my-3">
                <a href="https://accessercise.com/" target="_blank" class="h4 d-block">
                    https://accessercise.com/
                </a>
            </div>
            <h3><?=$lang['bemVindo']?></h3>
            <p class="h5"><?=$lang['parag_1']?></p>
            <p class="h5"><?=$lang['parag_2']?></p>
            <p class="h5"><?=$lang['parag_3']?></p>

            <!-- Botões App Store e Google Play -->
            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <a href="#" target="_blank">
                    <img src="img/home/dispGoogle.png" alt="Google Play" class="img-fluid" style="max-height:60px;">
                </a>
                <a href="#" target="_blank">
                    <img src="img/home/dispApple.png" alt="App Store" class="img-fluid" style="max-height:60px;">
                </a>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';