<?php
include 'config/config.php';
include 'includes/head.php';
getHead($lang['reposit'], $lang);
include '../includes/menu.php';
menu($lang['repositUp']);
?>
<div class="container">
    <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
        <div class="row">
            <div class="col-md-12 ">
                <a href="material.php" class="btn btnVerde btnMaterial bordVerde" role="button">
                    <?=$lang['material']?>
                </a>
            </div>
        </div>
        <!--form action="titulo.php">
            <div class="input-group mb-3 top20">
                <input type="text" name="b" class="form-control bordLaranja" placeholder="<?=$lang['pesquisa']?>" aria-label="<?=$lang['pesquisa']?>" aria-describedby="btnBusca">
                <button class="btn btnLaranja" type="submit" id="btnBusca"><img src="img/lupa.png" id="btnLupa"></button>
            </div>
        </form-->
        <div class="row">
            <div class="col-md-3 col-6 top20 ">
                <a href="palavra-chave.php" class="cardColor">
                    <div class="card text-center bordAzul" style="height: 8rem;">
                        <div class="card-body flex-box">
                            <?=$lang['chave']?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 top20">
                <a href="titulo.php" class="cardColor">
                    <div class="card text-center bordAzul" style="height: 8rem;">
                        <div class="card-body flex-box">
                            <?=$lang['pTitulo']?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 top20">
                <a href="autor.php" class="cardColor">
                    <div class="card text-center bordAzul" style="height: 8rem;">
                        <div class="card-body flex-box">
                            <?=$lang['autor']?>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-6 top20">
                <a href="tipos-de-trabalhos.php" class="cardColor">
                    <div class="card text-center bordAzul" style="height: 8rem;">
                        <div class="card-body flex-box">
                            <?=$lang['producao']?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
include 'includes/foot.php';