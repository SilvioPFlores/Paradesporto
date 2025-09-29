<?php
function getTrabalho2( $arrChave, $arrTpTrab, $arrTrab = null){
    ?>
    <div class="col-md-12">
        <div class="mb-3" id="divChkChave">
        <?php
        foreach ($arrChave as $dadoChave){
            foreach($arrTrab->chaves as $dadoChaveSelec){
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
                if ($dadoTpTrab[0] == $arrTrab->cd_tipo){
                    echo "<option value='$dadoTpTrab[0]' selected>$dadoTpTrab[1]</option>";
                }
                else{
                    echo "<option value='$dadoTpTrab[0]'>$dadoTpTrab[1]</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="autor">Autor(es)<span class="req"> *</span></label>
        <input type="text" class="form-control" name="autor" id="autor" placeholder="Alves, C.; Prado, D.T." maxlength="50" value="<?= $arrTrab->strAutor ?>" required>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="titulo">Título da Obra<span class="req"> *</span></label>
        <input type="text" class="form-control" name="titulo" id="titulo" maxlength="500" value='<?php echo str_replace("'", "&#39;", $arrTrab->ds_titulo) ?>' required>
    </div>
    <div class="col-md-12">
        <label class="form-label" for="publicadoPor">Revista / Editora / Instituição<span class="req"> *</span></label>
        <input type="text" class="form-control" name="publicadoPor" id="publicadoPor" maxlength="100" value="<?= $arrTrab->ds_publicado_por ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="isbn">ISBN</label>
        <input type="text" class="form-control" name="isbn" id="isbn" maxlength="20" value="<?= $arrTrab->ds_isbn ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label" for="cidade">Cidade ou País</label>
        <input type="text" class="form-control" name="cidade" id="cidade" maxlength="100" value="<?= $arrTrab->ds_cidade ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label" for="ano">Ano de Publicação</label>
        <input type="number" class="form-control" name="ano" id="ano" maxlength="4" value="<?= $arrTrab->ano_public ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label" for="pag">Páginas</label>
        <input type="text" class="form-control" name="pag" id="pag" placeholder="145-223" maxlength="15" value="<?= $arrTrab->ds_pagina ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label" for="volume">Volume</label>
        <input type="number" class="form-control" name="volume" id="volume" maxlength="5" value="<?= $arrTrab->ds_volume ?>">
    </div>
    <div class="col-md-12">
        <label class="form-label" for="url">URL<span class="req"> *</span></label>
        <div class="input-group mb-3">
            <input type="url" class="form-control" name="url" id="url" maxlength="2000" value="<?= $arrTrab->ds_url ?>">
            <button class="btn btn-outline-secondary" type="button" id="btnBuscaUrl" onClick="javascript: window.open(document.getElementById('url').value);" ><img src="img/web.png" id="btnLupa"></button>
        </div>
    </div>
    <div class="col-md">
        <input type="hidden" id="hdnNomeTrab" name="hdnNomeTrab" value="<?= $arrTrab->nm_arquivo ?>">
        <?php
        if ($arrTrab->ic_status == 'AT'){
            $caminho = "../repositorio/trabalhos/$arrTrab->nm_arquivo";
        }
        else{
            $caminho = "../repositorio/trabalhos/valid/$arrTrab->nm_arquivo";
        }
        if ($arrTrab->nm_arquivo != ''){
            echo "<a href='$caminho' target='_blank'><img src='../repositorio/img/pdf.png' style='width: 30px; height:auto;'></a>";
        }
        ?>
    </div>
    <?php
}