<?php
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
include 'config/config.php';
include 'includes/head.php';
getHead('Accessercise', $lang, '', 'css/css-home.css');
include 'includes/menu.php';
menu('ACCESSERCISE');

?>
<div class="container">
    <div class="text-center">
        <img src="img/home/accessQr.png" style="width:200px;">
        <div class="divAccess">
            <a href="https://accessercise.com/">https://accessercise.com/</a>
        </div>
        <br>
        <h3>
            <?=$lang['bemVindo']?>
        </h3>
        <p class="h5">
            <?=$lang['parag_1']?>
        </p>
        <p class="h5">
            <?=$lang['parag_2']?>
        </p>
        <p class="h5">
            <?=$lang['parag_3']?>
        </p>
        <br>
    </div>
    <div class="container text-center my-4">
        <div class="row justify-content-center align-items-center g-5">
            <div class="col-12 col-sm-auto">
                <div class="divDispGoogleApple">
                    <a href="#" target="_blank">
                        <img src="img/home/dispGoogle.png" alt="Instagram">
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-auto">
                <div class="divDispGoogleApple">
                    <a href="#">
                        <img src="img/home/dispApple.png" alt="Accessercise">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';