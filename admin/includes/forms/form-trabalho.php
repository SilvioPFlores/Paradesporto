<?php
function getTrabalho( $arrchave, $arrTpTrab, $arrTrab = null){
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3" id="divChkChave">
            <?php
            foreach ($arrchave as $dadoChave){
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <select class="form-select" id="cmbNaoSelec" aria-label="Chaves não selecionadas">
                <option selected value='0'>Selecione</option>
                <?php
                foreach($arrchave as $dadoNaoSelec){
                    echo "<option value='$dadoNaoSelec[0]'>$dadoNaoSelec[1]</option>";
                }
                ?>
                </select>
                <label for="cmbNaoSelec">Adicionar mais palavras-chaves</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <select class="form-select" id="cmbTipoTrabalho" name="cmbTipoTrabalho" aria-label="Chaves não selecionadas">
                <option selected value='100'>Selecione</option>
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
                <label for="cmbTipoTrabalho">Tipo de Trabalho</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="autor" id="autor" placeholder="Autor" value="<?= $arrTrab->strAutor ?>">
                <label for="autor">Autor:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value='<?php echo str_replace("'", "&#39;", $arrTrab->ds_titulo) ?>'>
                <label for="titulo">Título:</label>
            </div>
        </div>
    </div>
    <div class="row divTrabalhos">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="publicadoPor" id="publicadoPor" placeholder="publicadoPor" value="<?= $arrTrab->ds_publicado_por ?>">
                <label for="publicadoPor">Revista / Editora / Instituição:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="<?= $arrTrab->ds_isbn ?>">
                <label for="isbn">ISBN:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="ano" id="ano" placeholder="Ano" value="<?= $arrTrab->ano_public ?>">
                <label for="ano">Ano:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade ou País" value="<?= $arrTrab->ds_cidade ?>">
                <label for="cidade">Cidade ou País:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="pag" id="pag" placeholder="Páginas" value="<?= $arrTrab->ds_pagina ?>">
                <label for="pag">Páginas:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?= $arrTrab->ds_volume ?>">
                <label for="volume">Volume:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="dtAcesso" id="dtAcesso" placeholder="Data de acesso" value="<?= $arrTrab->dt_consulta ?>">
                <label for="dtAcesso">Data de acesso:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="url" id="url" placeholder="URLs" value="<?= $arrTrab->ds_url ?>">
                <label for="url">URLs:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="trabalhoPDF" class="form-label">Arquivo do Trabalho em PDF</label>
                <input class="form-control" type="file" id="trabalhoPDF" name='trabalhoPDF'>
                <div id="trabalhoPDFFeedback" class="invalid-feedback">
                    Somente arquivos no formato PDF.
                </div>
                <div id="trabalhoPDFSize" class="invalid-feedback">
                    Tamanha máximo para arquivo 300M.
                </div>
            </div>
            <br>
            <div class="progress">
                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="mb-3">
                <input type="hidden" id="hdnNomeTrab" name="hdnNomeTrab" value="<?= $arrTrab->nm_arquivo ?>">
                <?php
                if ($arrTrab->nm_arquivo != ''){
                    echo "<a href='../repositorio/trabalhos/$arrTrab->nm_arquivo' target='_blank'><img src='../repositorio/img/pdf.png' width='30px' height='30px' style='margin-top: 35px;'></a>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Conteúdo Publico?</label>
            </div>
            <?php
            if($arrTrab->ic_publico == 'S'){
                $chkSim = 'checked';
                $chkNao = '';
            }
            else{
                $chkSim = '';
                $chkNao = 'checked';
            }
            ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rdPublico" id="rdPublicoS" value="S" <?= $chkSim ?>>
                <label class="form-check-label" for="rdPublicoS">Sim</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rdPublico" id="rdPublicoN" value="N" <?= $chkNao ?>>
                <label class="form-check-label" for="rdPublicoN">Não</label>
            </div>
        </div>
    </div>
    <?php
}