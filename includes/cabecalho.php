<?php
function getCabecario($lang, $home = ''){
	?>
	<div class="container cabec">
		<div class="row">
			<div class="col-12 btnDireito">
				<div class="dropdown">
					<button class="btn btnVerde btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="img/head/lang-<?=$lang['lang']?>.png" class="bandeira"><?=$lang['lingua']?>
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="javascript:lingua('en');"><img src="img/head/lang-en.png" class="bandeira">English</a></li>
						<li><a class="dropdown-item" href="javascript:lingua('es');"><img src="img/head/lang-es.png" class="bandeira">Español</a></li>
						<li><a class="dropdown-item" href="javascript:lingua('pt-br');"><img src="img/head/lang-pt.png" class="bandeira">Português (Brasil)</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8 logo">
				<p class="text-center">
					<a href="index.php"><img src="img/head/logo.png" alt='<?=$lang['altParadesp']?>'></a>
				</p>
			</div>
			<div class="col-sm-4 ">
				<div class="d-flex logo-head logo">
					<?php
					if($home == ''){
						?>
						<div class="text-center">
							<a href="javascript: history.go(-1)" class="textoLinkCabec">
								<img src="img/head/voltar.png" style="width:130px; height:auto;"><br>
								<strong class="text-center"><?=$lang['volta']?></strong>
							</a>
						</div>
						<?php
					}
					?>
					<div class="">
						<a href="https://www.unifesp.br"><img src="img/head/logo-unifesp.png" alt='<?=$lang['altUnifesp']?>' style="width:120px; height:auto;"></a>
					<?php
					if($home != ''){
						?>
						<br>
						<a href="contato.php" class="btn btnVerde contato" role="button">
							<?=$lang['contato']?>
						</a><?php
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
}