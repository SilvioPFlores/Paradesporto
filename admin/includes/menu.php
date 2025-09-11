<?php
function getMenu($nivel){
    ?>
    <nav class="navbar navbar-expand-md navbar-dark corVerde">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo_negativo.png" width='150px' height='100px'>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <?php
                if($nivel != ''){
                    ?>
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Trabalhos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="trabalho.php">Cadastrar</a></li>
                                <li><a class="dropdown-item" href="csv.php?t=gm">Importar CSV</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="consulta.php">Consultar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="trabalhoAutor.php">Recebidos de Autores</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chaves.php">Palavras chaves</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Projeto
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="objetivo.php">Objetivo</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="pronome.php">Pronomes de tratamento</a></li>
                                <li><a class="dropdown-item" href="cargo.php">Cargos</a></li>
                                <li><a class="dropdown-item" href="equipe.php">Equipe</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="producao.php">Produção</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Informações
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="infoVisitas.php">Visitas</a></li>
                                <li><a class="dropdown-item" href="infoChave.php">Palavras-chave</a></li>
                                <li><a class="dropdown-item" href="infoDownload.php">Downloads</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="infoContadores.php">Contadores</a></li>
                            </ul>
                        </li>
                        <?php
                        if($nivel != ''){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="planilhaTodos.php">Gerar Planilha</a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="acesso.php">Acessos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <li class="nav-item py-1 col-12 col-lg-auto">
                            <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                            <hr class="d-lg-none text-white-50">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="logout.php">Sair</a>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <?php
}