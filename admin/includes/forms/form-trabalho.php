<?php
function getTrabalho( $arrchave, $arrTpTrab, $arrTrab = null){
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3" id="divChkChave">
            <?php
            foreach ($arrchave as $dadoChave){
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
                    if ($dadoTpTrab[0] == $arrTrab[15]){
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
                <input type="text" class="form-control" name="autor" id="autor" placeholder="Autor" value="<?= $arrTrab[count($arrTrab) - 2] ?>">
                <label for="autor">Autor:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value='<?php echo str_replace("'", "&#39;", $arrTrab[0]) ?>'>
                <label for="titulo">Título:</label>
            </div>
        </div>
    </div>
    <div class="row divTrabalhos">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="revista" id="revista" placeholder="Revista" value="<?= $arrTrab[1] ?>">
                <label for="revista">Revista:</label>
            </div>
        </div>
    </div>
    <div class="row divLivro">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="editora" id="editora" placeholder="Editora" value="<?= $arrTrab[2] ?>">
                <label for="editora">Editora:</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="<?= $arrTrab[3] ?>">
                <label for="isbn">ISBN:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="ano" id="ano" placeholder="Ano" value="<?= $arrTrab[4] ?>">
                <label for="ano">Ano:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="pag" id="pag" placeholder="Páginas" value="<?= $arrTrab[5] ?>">
                <label for="pag">Páginas:</label>
            </div>
        </div>
        <div class="col-md-4 divTrabalhos">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="volume" id="volume" placeholder="Volume" value="<?= $arrTrab[6] ?>">
                <label for="volume">Volume:</label>
            </div>
        </div>
        <div class="col-md-4 divLivro">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade ou País" value="<?= $arrTrab[7] ?>">
                <label for="cidade">Cidade ou País:</label>
            </div>
        </div>
    </div>
    <div class="row divTrabalhos">
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="instit" id="instit" placeholder="Instituição" value="<?= $arrTrab[8] ?>">
                <label for="instit">Instituição:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="data" id="data" placeholder="Data de Publicação" value="<?= $arrTrab[9] ?>">
                <label for="data">Data de Publicação:</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="dtAcesso" id="dtAcesso" placeholder="Data de acesso" value="<?= $arrTrab[10] ?>">
                <label for="dtAcesso">Data de acesso:</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="url" id="url" placeholder="URLs" value="<?= $arrTrab[11] ?>">
                <label for="url">URLs:</label>
            </div>
        </div>
    </div>
    <div class="row divTrabalhos">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="doi" id="doi" placeholder="DOI" value="<?= $arrTrab[12] ?>">
                <label for="doi">DOI:</label>
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
                <input type="hidden" id="hdnNomeTrab" name="hdnNomeTrab" value="<?= $arrTrab[13] ?>">
                <?php
                if ($arrTrab[13] != ''){
                    echo "<a href='../repositorio/trabalhos/$arrTrab[13]' target='_blank'><img src='../repositorio/img/pdf.png' width='30px' height='30px' style='margin-top: 35px;'></a>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Conteúdo Publico?</label>
            </div>
            <?php
            if($arrTrab[14] == 'S'){
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