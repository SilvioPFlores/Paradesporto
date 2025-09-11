<?php
function getCabecario($lang, $home = ''){
	?>
	<div class="container cabec">
		<div class="row">
			<div class="col-12 btnDireito">
				<div class="dropdown">
					<button class="btn btnVerde btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="../img/head/lang-<?=$lang['lang']?>.png" class="bandeira"><?=$lang['lingua']?>
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="javascript:lingua('en');"><img src="../img/head/lang-en.png" class="bandeira">English</a></li>
						<li><a class="dropdown-item" href="javascript:lingua('es');"><img src="../img/head/lang-es.png" class="bandeira">Español</a></li>
						<li><a class="dropdown-item" href="javascript:lingua('pt-br');"><img src="../img/head/lang-pt.png" class="bandeira">Português (Brasil)</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8 logo">
				<p class="text-center">
					<a href="index.php"><img src="../img/head/logo.png"></a>
				</p>
			</div>
			<div class="col-sm-4 ">
				<div class="d-flex logo-head logo">
					<?php
					if($home == ''){
						?>
						<div class="text-center">
							<a href="javascript: history.go(-1)" class="textoLinkCabec">
								<img src="../img/head/voltar.png" width='130px' height='130px'><br>
								<strong class="text-center"><?=$lang['volta']?></strong>
							</a>
						</div>
						<?php
					}
					?>
					<div>
						<a href="https://www.unifesp.br"><img src="../img/head/logo-unifesp.png" width='120px' height='60px'></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}