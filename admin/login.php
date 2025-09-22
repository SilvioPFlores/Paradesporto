<?php
require_once "db/dbConnection.php";
include_once "query/query-acesso.php";
if (isset($_POST['entrarLogin'], $_POST['login'], $_POST['senha']) && $_POST['entrarLogin'] == 'true') {
	$arrLogin = login($conn, $_POST['login'], md5($_POST['senha']));
	if ($arrLogin != '') {
		$_SESSION['repositorio']['nivel'] = $arrLogin[0];
		$_SESSION['repositorio']['cdAcesso'] = $arrLogin[1];
		$_SESSION['repositorio']['user'] = $_POST['login'];
		Header("location:index.php");
	} else {
		$erroLogin =  'Usuário ou senha incorreto';
	}
}
include 'includes/head.php';
getHead('Login', "css/css-login.css");
include 'includes/menu.php';
getMenu('');
$erroLogin = '';
?>
<div class="page" id="page">
	<div class='login' id='divLogin'>
		<br>
		<h1>Login</h1>
		<br>
		<form action="login.php" method="POST">
			<input type="hidden" name="entrarLogin" value="true">
			<div class="container">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="login" id="login" placeholder="Usuário" required>
					<label for="login">Usuário:</label>
				</div>
				<div class="form-floating mb-3">
					<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
					<label for="senha">Senha:</label>
				</div>
				<div class="row">
					<div class="col">
						<span id="spErrLogin">&nbsp<?= $erroLogin; ?></span>
					</div>
				</div>
				<div class="center">
					<input type="submit" id='btnEntrarLogin' class="btn btn-success" value="Entrar">
				</div>
			</div>
		</form>
		<br>
	</div>
</div>
<?php
include 'includes/foot.php';