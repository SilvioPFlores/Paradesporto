<?php
function getUsuario($arrUsuario){
    ?>
    <div class="col-12">
        <label for="txtNome" class="form-label">Nome</label>
        <input type="text" class="form-control" name="txtNome" id="txtNome" value="<?=$arrUsuario['ds_usuario']?>" disabled>
    </div>
    <div class="col-12">
        <label for="txtMail" class="form-label">E-mail</label>
        <input type="mail" class="form-control" name="txtMail" id="txtMail" value="<?=$arrUsuario['ds_mail']?>" disabled>
    </div>
    <div class="col-md-4 col-sm-8">
        <label for="phone" class="form-label">Telefone</label><br>
        <input type="tel" class="form-control" name="phone" id="phone" value="<?=$arrUsuario['ds_fone']?>" disabled>
    </div>
    <div class="col-md-8">
        <label for="txtNacio" class="form-label">Nacionalidade</label>
        <input type="text" class="form-control" name="txtNacio" id="txtNacio" value="<?=$arrUsuario['ds_nacionalidade']?>" disabled>
    </div>
    <?php
}