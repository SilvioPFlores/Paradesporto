<?php
function buscaPor ($lang, $letra, $pag){
    $arrAlfa = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    echo '
    <div class="row justify-content-md-center">
        <div class="col-md-auto">';
        echo $lang['buscaLetra'];
        if($letra == ''){
            echo ' '.$lang['all'];
        }else{
        echo " <a href='$pag'>".$lang['all']."</a>"; 
        }
        foreach ($arrAlfa as $dadoAlfa){
            if($dadoAlfa != $letra){
                echo " <a href='$pag?l=$dadoAlfa'>$dadoAlfa</a>";
            }
            else{
                echo " $dadoAlfa";
            }
        }
        ?>
        </div>
    </div>
    <br>
    <br>
    <?php
}