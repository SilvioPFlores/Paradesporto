<?php
require_once 'db/dbConnection.php';
require_once 'query/query-visitas.php';
if (isset($_POST['buscaPeriodo']) && $_POST['buscaPeriodo'] == 'true'){
    if (isset($_POST['dtInicio'],$_POST['dtFim'])){
        $arrPeriodo = buscaPeriodo($conn, array(':dtInicio' => $_POST['dtInicio'], ':dtFim' => $_POST['dtFim']));
        $arrPeriodo[2] = date('d/m/Y',strtotime($_POST['dtInicio']));
        $arrPeriodo[3] = date('d/m/Y',strtotime($_POST['dtFim']));
        echo json_encode($arrPeriodo);
    }
}
else{
    require_once 'includes/head.php';
    getHead("Visitas", '', 'js/js-visita.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
    
        $ano = date('Y');
        if (isset($_GET['cod'])) {
            $cod = $_GET['cod'];
        } else {
            $cod = $ano;
        }
        if (isset($_GET['cod2'])) {
            $cod2 = $_GET['cod2'];
        } else {
            $cod2 = $ano;
        }
        $mesAtual = date('m');
        if (isset($_GET['mes'])) {
            $mes = $_GET['mes'];
        } else {
            $mes = $mesAtual;
        }
        $arrGeral = buscaGeral($conn);

        $arrDias15 = buscaPorDias($conn, array(':qtdDias' => 15));
        $arrDias30 = buscaPorDias($conn, array(':qtdDias' => 30));
        $arrDias60 = buscaPorDias($conn, array(':qtdDias' => 60));

        $arrPalavra = buscaPalavras($conn);
        $totTrabalho = buscaTotalTrabalhos($conn);
        $totAutor = buscaTotalAutor($conn);
        $totPalavra = buscaTotalPalavras($conn);
    ?>
        <div class="container">
            <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
                <h3>Informações Gerais</h3>
                <br>
                <div class="divPq">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Total de Visitas</th>
                                <td><?= $arrGeral[0] ?></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">Total de IP's</th>
                                <td><?= $arrGeral[1] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <h3>Informações recentes</h3>
                <br>
                <div class="divMd">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center table-success">
                                <th scope="col"></th>
                                <th scope="col">15 dias</th>
                                <th scope="col">30 dias</th>
                                <th scope="col">60 dias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Visitas</th>
                                <td><?= $arrDias15[0] ?></td>
                                <td><?= $arrDias30[0] ?></td>
                                <td><?= $arrDias60[0] ?></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">IP's</th>
                                <td><?= $arrDias15[1] ?></td>
                                <td><?= $arrDias30[1] ?></td>
                                <td><?= $arrDias60[1] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <h3>Informações por ano</h3>
                <div class="text-center">
                    <?php
                    $anoInicio = 2023;
                    for ($i = $anoInicio; $i <= $ano; $i++) {
                        if ($i == $cod) {
                            echo "<a href='infoVisitas.php?cod=$i' id='btnEstat-$i' class='btn btn-success' aria-current='page'>$i</a>";
                        } else {
                            echo "<a href='infoVisitas.php?cod=$i' id='btnEstat-$i' class='btn btn-outline-success'>$i</a>";
                        }
                    }
                    ?>
                </div>
                <br>
                <br>
                <div class="divMd">
                    <table class="table table-striped-columns">
                        <thead>
                            <tr class="text-center table-success">
                                <th scope="col"></th>
                                <th scope="col">Visitas</th>
                                <th scope="col">IP's</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($m = 1; $m <= 12; $m++) {
                                $arrMes = buscaPorMes($conn, array(':mes' => $m, ':ano' => $cod));
                                $dado1 = $arrMes[0] != 0 ? $arrMes[0] : '-';
                                $dado2 = $arrMes[1] != 0 ? $arrMes[1] : '-';
                                echo "
                                <tr class='text-center'>
                                    <th scope='row'>" . mesPt($m) . "</th>
                                    <td>$dado1</td>
                                    <td>$dado2</td>
                                </tr>";
                            }
                            $arrAno = buscaPorAno($conn, array(':ano' => $cod));
                            $dado3 = $arrAno[0] != 0 ? $arrAno[0] : '-';
                            $dado4 = $arrAno[1] != 0 ? $arrAno[1] : '-';
                            echo "
                            <tr class='text-center table-success'>
                                <th scope='row'>Total</th>
                                <td>$dado3</td>
                                <td>$dado4</td>
                            </tr>";
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <h3>Período personalizado</h3>
                <br>
                <div class="divMd">
                    <div class="row g-3">
                        <input type="hidden" id="buscaPeriodo" name="buscaPeriodo" value="true">
                        <div class="col-md-5">
                            <label for="inputEmail4" class="form-label">De</label>
                            <input type="date" class="form-control" id="dataInicio">
                        </div>
                        <div class="col-md-5">
                            <label for="inputPassword4" class="form-label">Até</label>
                            <input type="date" class="form-control" id="dataFim">
                        </div>
                        <div class="col-2" style="margin-top: 43px;">
                            <input id="btnPeriodo" type="button" class="btn btn-primary topMarg4" value="Buscar">
                        </div>
                    </div>
                </div>
                <br>
                <div class="divPq d-none" id="divPeriodo">
                    <div class="text-center">
                        <h5 id="titPeriodo"></h5>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Visitas</th>
                                <td><span id="spTotVisitas"></span></td>
                            </tr>
                            <tr class="text-center">
                                <th scope="row">IP's</th>
                                <td><span id="spTotIps"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
        
        <!-- nova parte -->
        <div class="container">
            <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
                <h3>Contadores</h3>
                <br>
                <div class="divPq">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Trabalhos</th>
                                <th scope="row">Palavras-chave</th>
                                <th scope="row">Autores</th>
                            </tr>
                            <tr>
                                <td class='text-center'> <?=$totTrabalho?></td>
                                <td class='text-center'> <?=$totPalavra?></td>
                                <td class='text-center'> <?=$totAutor?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>

        <div class="container">
            <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
                <h3>Palavras-chave</h3>
                <hr>
                <br>
                <div class="text-center">
                    <h5>Mais Buscadas</h5>
                    <?php
                    $anoInicio = 2024;
                    for ($i = $anoInicio; $i <= $ano; $i++) {
                        if ($i == $cod2) {
                            echo "<a href='infoVisitas.php?cod2=$i' id='btnEstat-$i' class='btn btn-success' aria-current='page'>$i</a>";
                        } else {
                            echo "<a href='infoVisitas.php?cod2=$i' id='btnEstat-$i' class='btn btn-outline-success'>$i</a>";
                        }
                    }
                    ?>
                    <div class="divPq">
                        <hr>
                    </div>
                    <?php
                    $arrMes = buscaMesesPorAno($conn, array(':ano' => $cod2));
                    foreach ($arrMes as $x) {
                        if ($x[0] == $mes) {
                            echo "<a href='infoVisitas.php?mes=$x[0]' id='btnEstat-$x[0]' class='btn btn-primary' aria-current='page'>".mesPt($x[0])."</a>";
                        } else {
                            echo "<a href='infoVisitas.php?mes=$x[0]' id='btnEstat-$x[0]' class='btn btn-outline-primary'>".mesPt($x[0])."</a>";
                        }
                    }
                    $totContChave = buscaTotContChaveMes($conn, array(':mes' => $mes));
                    $arrQtdMes = buscaQtdPorMes($conn, array(':mes' => $mes));
                    ?>
                    <br>
                    <br>
                    <div class="divMd">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Palavras clicadas no Mês</th>
                                    <th scope="row"><?= $totContChave ?></th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                            <tr class="text-center table-success">
                                    <th scope="row">Palavra-chave</th>
                                    <th scope="row">Qtd de Cliques</th>
                                </tr>
                                <?php
                                foreach ($arrQtdMes as $dadoQtd){
                                    echo"
                                    <tr>
                                        <td> $dadoQtd[0]</td>
                                        <td class='text-center'>$dadoQtd[1]</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>

                <div class="divPq">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="text-center">
                                <th scope="row">Cód</th>
                                <th scope="row">Palavra</th>
                            </tr>
                            <?php
                            foreach ($arrPalavra as $dadoPalavra){
                                echo"
                                <tr>
                                    <td class='text-center'> $dadoPalavra[0]</td>
                                    <td>$dadoPalavra[1]</td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    <?php
    } else {
        header("Location: index.php");
    }
    require_once "includes/foot.php";
}
function mesPt($m)
{
    $mesPort = array(
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro'
    );
    return $mesPort[$m];
}