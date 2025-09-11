<?php
function menu($titulo = ''){
    ?>
    <nav class="navbar navbar-expand corVerde">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-center">
                <?php
                if($titulo != ''){
                    echo "<span class='navbar-brand mb-0 h1 nomeMenu'>$titulo</span>";
                }
                ?>
            </div>
        </div>
    </nav>
    <?php
}