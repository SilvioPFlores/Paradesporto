<?php
function getTrabalho2( $arrChave, $arrTpTrab, $arrTrab = null){
    ?>
    <div class="col-md-12">
        <div class="mb-3" id="divChkChave">
        <?php
        foreach ($arrChave as $dadoChave){
            foreach($arrTrab[count($arrTrab) - 1] as $dadoChaveSelec){
                if($dadoChaveSelec[0] == $dadoChave[0]){
                    echo"
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='$dadoChave[0]' name='chkChave[]' id='chkChave$dadoChave[0]' checked>
                        <label class='form-check-label' for='chkChave$dadoChave[0]'>
                            $dadoChave[1]
                        </label>
                    </div>";
                }
            }
        }
        ?>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="cmbNaoSelec">Escolher palavras-chaves</label>
        <select class="form-select" id="cmbNaoSelec">
            <option selected value='0'>Selecione</option>
            <?php
            foreach($arrChave as $dadoNaoSelec){
                echo "<option value='$dadoNaoSelec[0]'>$dadoNaoSelec[1]</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="cmbTipoTrabalho">Tipo de Trabalho<span class="req"> *</span></label>
        <select class="form-select" id="cmbTipoTrabalho" name="cmbTipoTrabalho" required>
            <option selected value=''>Selecione</option>
            <?php
            foreach($arrTpTrab as $dadoTpTrab){
                if($dadoTpTrab[0] == 4){
                    $iten = 'Relatório';
                }
                else{
                    $iten = $dadoTpTrab[1];
                }
                if ($dadoTpTrab[0] == $arrTrab[15]){
                    echo "<option value='$dadoTpTrab[0]' selected>$iten</option>";
                }
                else{
                    echo "<option value='$dadoTpTrab[0]'>$iten</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="autor">Autor(es)<span class="req"> *</span></label>
        <input type="text" class="form-control" name="autor" id="autor" placeholder="Alves C, Prado DT..." maxlength="50" value="<?= $arrTrab[count($arrTrab) - 2] ?>" required>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="titulo">Título da Obra<span class="req"> *</span></label>
        <input type="text" class="form-control" name="titulo" id="titulo" maxlength="500" value='<?php echo str_replace("'", "&#39;", $arrTrab[0]) ?>' required>
    </div>
    <div class="col-md-12 cd0 cd8">
        <label class="form-label" for="revista">Revista<span class="req"> *</span></label>
        <input type="text" class="form-control in0 in8" name="revista" id="revista" maxlength="100" value="<?= $arrTrab[1] ?>">
    </div>
    <div class="col-md-6 cd0 cd3 cd5">
        <label class="form-label" for="editora">Editora<span class="req"> *</span></label>
        <input type="text" class="form-control in0 in3 in5" name="editora" id="editora" maxlength="200" value="<?= $arrTrab[2] ?>">
    </div>
    <div class="col-md-6 cd0 cd3 cd5">
        <label class="form-label" for="isbn">ISBN<span class="req"> *</span></label>
        <input type="text" class="form-control in0 in3 in5" name="isbn" id="isbn" maxlength="20" value="<?= $arrTrab[3] ?>">
    </div>
    <div class="col-md-4 cd0 cdAll">
        <label class="form-label" for="ano">Ano de Publicação</label>
        <input type="number" class="form-control" name="ano" id="ano" maxlength="4" value="<?= $arrTrab[4] ?>">
    </div>
    <div class="col-md-4 cd0 cd1 cd2 cd3 cd4 cd5 cd8">
        <label class="form-label" for="pag">Páginas<span class="req"> *</span></label>
        <input type="text" class="form-control in0 in1 in2 in3 in4 in5 in8" name="pag" id="pag" placeholder="145-223" maxlength="15" value="<?= $arrTrab[5] ?>">
    </div>
    <div class="col-md-4 cd0 cd1 cd2 cd4 cd8">
        <label class="form-label" for="volume">Volume<span class="req"> *</span></label>
        <input type="number" class="form-control in0 in1 in2 in4 in8" name="volume" id="volume" maxlength="5" value="<?= $arrTrab[6] ?>">
    </div>
    <div class="col-md-4 cd0 cdAll">
        <label class="form-label" for="cidade">Cidade ou País<span class="req"> *</span></label>
        <input type="text" class="form-control in0 inAll" name="cidade" id="cidade" maxlength="100" value="<?= $arrTrab[7] ?>">
    </div>
    <div class="col-md-8 cd0 cd1 cd2 cd4 cd6">
        <label class="form-label" for="instit">Instituto<span class="req"> *</span></label>
        <input type="text" class="form-control in0 in1 in2 in4 in6" name="instit" id="instit" maxlength="200" value="<?= $arrTrab[8] ?>">
    </div>
    <div class="col-md-4 cd0 cd1 cd2 cd4 cd8">
        <label class="form-label" for="data">Data de Publicação</label>
        <input type="date" class="form-control" name="data" id="data" value="<?= $arrTrab[9] ?>">
    </div>
    <div class="col-md-12 cd0 cdAll">
        <label class="form-label" for="url">URL<span class="req"> *</span></label>
        <div class="input-group mb-3">
            <input type="url" class="form-control in0 inAll" name="url" id="url" maxlength="2000" value="<?= $arrTrab[11] ?>">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscaUrl" onClick="javascript: window.open(document.getElementById('url').value);" ><img src="img/web.png" id="btnLupa"></button>
        </div>
    </div>
    <div class="col-md-12 cd0 cdAll">
        <label class="form-label" for="doi">DOI</label>
        <div class="input-group mb-3">
            <input type="url" class="form-control" name="doi" id="doi"  maxlength="500" value="<?= $arrTrab[12] ?>">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscaDoi" onClick="javascript: window.open(document.getElementById('doi').value);" ><img src="img/web.png" id="btnLupa"></button>
        </div>
    </div>
    <div class="col-md cd0 cdAll">
        <input type="hidden" id="hdnNomeTrab" name="hdnNomeTrab" value="<?= $arrTrab[13] ?>">
        <?php
        if ($arrTrab[16] == 'AT'){
            $caminho = "../repositorio/trabalhos/$arrTrab[13]";
        }
        else{
            $caminho = "../repositorio/trabalhos/valid/$arrTrab[13]";
        }
        if ($arrTrab[13] != ''){
            echo "<a href='$caminho' target='_blank'><img src='../repositorio/img/pdf.png' style='width: 30px; height:auto;'></a>";
        }
        ?>
    </div>
    <?php
}