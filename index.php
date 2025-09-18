<?php
include 'config/config.php';
include 'includes/head.php';
getHead($lang['titulo'], $lang, 'home', 'css/css-home.css');
include 'includes/menu.php';
menu();
?>
<div class="container">
    <!--div class="centro row row-cols-md-5 g-4 top40">
        <div class="col">
            <a href="congresso/"  target="_blank">
                <div class="card text-center cardHome responsive-bord-azul h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/congresso.png" alt="Segundo Congresso Brasileiro de Pedagogia do para desporto">
                    </div>
                </div>
            </a>
        </div>
    </div-->
    <div class="row row row-cols-1 row-cols-md-5 g-4 top40">
        <div class="col">
            <a href="https://anchor.fm/paradesporto" target="_blank">
                <div class="card text-center cardHome responsive-bord h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/podcast.png" alt="">
                        <strong class="responsive-font-example">PODCAST</strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="repositorio/">
                <div class="card text-center cardHome responsive-bord rounded-4 h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/paradesporto.png" alt="">
                        <strong class="responsive-font-example"><?= $lang['reposit'] ?></strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="https://www.youtube.com/@paradesportoacessivel" target="_blank">
                <div class="card text-center cardHome responsive-bord rounded-4 h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/logo-youtube.png" alt="">
                        <strong class="responsive-font-example"><?= $lang['canal'] ?></strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="producao/">
                <div class="card text-center cardHome responsive-bord rounded-4 h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/producao.png" alt="">
                        <strong class="responsive-font-example"><?= $lang['producao'] ?></strong>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="projeto.php">
                <div class="card text-center cardHome responsive-bord rounded-4 h-100">
                    <div class="card-body responsive-bory-card">
                        <img class="card-img-top" src="img/home/paradesporto.png" alt="">
                        <strong class="responsive-font-example"><?= $lang['projeto'] ?></strong>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="container text-center my-4">
        <div class="row justify-content-center align-items-center g-3">
            <div class="col-12 col-sm-auto">
                <div class="divInsta">
                    <a href="https://www.instagram.com/paradesporto_br/" target="_blank" class="d-inline-flex align-items-center gap-2 text-decoration-none">
                        <img src="img/home/logo-insta.png" alt="Instagram">
                        <strong>@paradesporto_br</strong>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-auto">
                <div class="divAccess">
                    <a href="https://www.instagram.com/paradesporto_br/" target="_blank">
                        <img src="img/home/access.png" alt="Accessercise">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';
