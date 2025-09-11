<?php
session_start();
include 'config/config.php';
include 'includes/head.php';
getHead($lang['congMenu'], $lang, 'home');
include 'includes/menu.php';
?>
<div class="container">
	<div class="divMed">
		<div data-bs-spy="scroll" data-bs-target="#navScroll" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="bg-body-tertiary p-3 rounded-2" tabindex="0">
			<div class=" centro">
				<a href="banner.php">
					<button type="button" class="btn btn-azul"><?=$lang['congBtn']?></button>
				</a>
			</div>
			<br>
			<div id="pag1" class="pag pag1">
				<div class="texto1">
					<i>
						<span class="cor1">2º CONGRESSO </span> <br>
						<span class="cor2"> BRASILEIRO DE</span> <br>
						<span class="cor2"> PEDAGOGIA DO</span> <br>
						<span class="cor1"> PARADESPORTO </span> <br>
						<span class="cor1 "><b> /// </b></span> 
						<div class="divData centro">21 e 22<br>de novembro</div>
						<div class="imgLogo"><img src="../img/head/logo.png" alt='<?=$lang['altParadesp']?>'></div>
						<div class="textoInsta0 centro">
							<a class="cor2" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								@paradesporto_br
							</a>
						</div> 
					</i>
				</div>
			</div> 
			<br>
			<h4 id="pag2">Live</h4>
			<div class="pag pag2">
				<div class="texto2 centro">
					<i>
						<span class="cor3">O EVENTO TERÁ TRANSMISSÃO</span> <br>
						<span class="cor3">EM NOSSO CANAL DO YOUTUBE</span> <br>
					</i>
					<div>
						<div class="textoPres">
							Presencial
						</div>
						<div class="divLive">
							<img src="img/live.png" class="imgLive">
						</div>
						<div class="row">
							<div class="col-3">
								<div class="divLibras">
									<img src="img/libras.png" class="imgLibras"> 
								</div>
								<div class="textoLibras">
									<span>Acessível em LIBRAS</span>
								</div>
							</div>
							<div class="col-9">
								<div class="textoLocal">
									<div>
										<img src="img/loc_verde.png" class="imgLoc" alt="Localização">
										São Paulo Expo 
										Rod. Imigrantes, km 1,5
										Vl. Água Funda, São Paulo - SP
									</div>
									<div>
										<img src="img/calend_verde.png" class="imgLoc" alt="Data"> 21/11 e 22/11
									</div>
								</div>
							</div>
						</div>
						<div class="centro">
							<div class="row cor3">
								<div class=" col-4">
									<div class="barra dir">
										<span><i><b>///</b></i></span>
									</div>
								</div>
								<div class=" col-4">
									<div class="textoInscri2">
										<span>INSCRIÇÕES NO SITE:</span><br>
										<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
									</div>
								</div>
								<div class=" col-4">
									<div class="barra esq">
										<span><i><b>///</b></i></span>
									</div>
								</div>
								<div class="textoInsta">
									<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
										<i>@paradesporto_br</i>
									</a>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div> 
			<br>
			<h4 id="pag3">Trilha</h4>
			<div class="pag pag3">
				<div class="texto2 centro">
					<i>
						<span class="cor3">TEREMOS NOSSA <u>TRILHA</u> DE PREPARAÇÃO</span> <br>
						<span class="cor3">PARA O CONGRESSO <u>100% ONLINE</u></span> <br>
					</i>
					<div class="row top1 bottom1 ">
						<div class="col-2 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 "></div>
						<div class="col-4 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
							<div class="textoOnline">
								Online
							</div>
							<div class="divLibras2">
								<img src="img/libras.png" class="imgLibras2"> 
							</div>
							<div class="textoLibras">
								<span>Acessível em LIBRAS</span>
							</div>
						</div>
						<div class="col-4 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 ">
							<div class="texto3">
								<div>
									 <span class="cor4">DATAS</span><br>
									 <span class="cor3">14/09</span><br>
									 <span class="cor3">21/09</span><br>
									 <span class="cor3">05/10</span><br>
									 <span class="cor3">26/10</span>
								</div>
							</div>
						</div>
						<div class="col-2 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 "></div>
					</div>
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<h4 id="pag4">14/09</h4>
			<div class="pag pag4">
				<div class="divPag4 centro">
					<div class="textoData">
						<strong class="cor1">Data 14/09</strong><br>
						<strong class="cor1">Início 14:00</strong><br>
					</div>
					<div class="divTema">
						<span class="textoTema1 cor1">TEMA:</span>
						<span class="textoTema2 cor2">MULHERES NO PARADESPORTO</span><br>
					</div>
					<div class="divLibras2">
						<img src="img/libras.png" class="imgLibras3"> 
					</div>
					<div class="textoLibras bottom2">
						<span>Acessível em LIBRAS</span>
					</div>
				</div>
				<div class="centro">
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<h4 id="pag5">21/09</h4>
			<div class="pag pag5">
				<div class="divPag4 centro">
					<div class="textoData">
						<strong class="cor1">Data 21/09</strong><br>
						<strong class="cor1">Início 14:00</strong><br>
					</div>
					<div class="divTema">
						<span class="textoTema1 cor1">TEMA:</span>
						<span class="textoTema2 cor2">TEA E O PARADESPORTO</span><br>
					</div>
					<div class="divLibras2">
						<img src="img/libras.png" class="imgLibras3"> 
					</div>
					<div class="textoLibras bottom2">
						<span>Acessível em LIBRAS</span>
					</div>
				</div>
				<div class="centro">
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<h4 id="pag6">05/10</h4>
			<div class="pag pag6">
				<div class="divPag4 centro">
					<div class="textoData">
						<strong class="cor1">Data 05/10</strong><br>
						<strong class="cor1">Início 14:00</strong><br>
					</div>
					<div class="divTema">
						<span class="textoTema1 cor1">TEMA:</span>
						<span class="textoTema2 cor2">AVALIAÇÃO NO PARADESPORTO</span><br>
					</div>
					<div class="divLibras2">
						<img src="img/libras.png" class="imgLibras3"> 
					</div>
					<div class="textoLibras bottom2">
						<span>Acessível em LIBRAS</span>
					</div>
				</div>
				<div class="centro">
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<h4 id="pag7">26/10</h4>
			<div class="pag pag7">
				<div class="divPag7 centro">
					<div class="textoData">
						<strong class="cor1">Data 26/10</strong><br>
						<strong class="cor1">Início 14:00</strong><br>
					</div>
					<div class="divTema2">
						<span class="textoTema3 cor1">TEMA:</span>
						<span class="textoTema4 cor2">SISTEMAS DE CLASSIFICAÇÃO NO<br>PARADESPORTO</span><br>
					</div>
					<div class="divLibras3">
						<img src="img/libras.png" class="imgLibras4"> 
					</div>
					<div class="textoLibras bottom2">
						<span>Acessível em LIBRAS</span>
					</div>
				</div>
				<div class="centro">
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<h4 id="pag8">Envio</h4>
			<div class="pag pag8">
				<div class="texto8 centro">
					<div>SUBMISSÃO DE TRABALHOS CIENTÍFICOS</div>
				</div>
				<div class="control">
					
					<div class="row">
						<div class="col-6 centro">
							<div class="texto9">
								1. Iniciação esportiva e modelos de ensino no
							</div>
							<div class="texto9">
								Paradesporto
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-1"></div>
						<div class="col-6 centro">
							<div class="texto9">
								2. Aperfeiçoamento e caminhos na formação
							</div>
							<div class="texto9">
								do atleta no Paradesporto
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-2"></div>
						<div class="col-6 centro esp">
							<span class="texto9">
								3. Desempenho do atleta do Paradesporto
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-3"></div>
						<div class="col-7 col-sm-7 col-md-8 centro esp">
							<span class="texto9">
								4. Formação de professores e treinadores no Paradesporto
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-4"></div>
						<div class="col-6 centro esp">
							<span class="texto9">
								5. Políticas Públicas para o Paradesporto
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-5"></div>
						<div class="col-6 centro esp">
							<span class="texto9">
								6. Estudos socioculturais e o Paradesporto
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-6"></div>
						<div class="col-6 centro esp">
							<span class="texto9">
								7. Avaliação dos atletas no Paradesporto.
							</span>
						</div>
					</div>
					<div class="superior">
						<div class="row">
							<div class="col texto10">
								ATENÇÃO
							</div>
						</div>
						<div class="row">
							<div class="col texto11">
								ENVIO DE TRABALHOS
							</div>
						</div>
						<div class="row">
							<div class="col texto11">
								<strike>15 MAIO A 15 DE JULHO</strike>
							</div>
						</div>
						<div class="row">
							<div class="col texto11 cor4">
								<u>AMPLIADO ATÉ 15 DE AGOSTO</u>
							</div>
						</div>
					</div>
					<div class="inferior">
						<div class="row">
							<div class="col texto10">
								ATENÇÃO
							</div>
						</div>
						<div class="row">
							<div class="col texto11">
								COMUNICAÇÃO ORAL
							</div>
						</div>
						<div class="row">
							<div class="col texto11">
								<u>Data 09/11/2024</u>
							</div>
						</div>
					</div>
				</div>
				<div class="centro">
					<div class="row cor3">
						<div class=" col-4">
							<div class="barra dir">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class=" col-4">
							<div class="textoInscri2">
								<span>INSCRIÇÕES NO SITE:</span><br>
								<a class="cor3" href="https://siex.siiu.unifesp.br/catalogo-siex">SIEX.SIIU.UNIFESP.BR/CATALOGO-SIEX</a>
							</div>
						</div>
						<div class=" col-4">
							<div class="barra esq">
								<span><i><b>///</b></i></span>
							</div>
						</div>
						<div class="textoInsta2">
							<a class="cor3" href="https://www.instagram.com/paradesporto_br/" target="_blank">
								<i>@paradesporto_br</i>
							</a>
						</div>	
					</div>
				</div>
			</div>
			<br>
			<div class=" centro">
				<a href="normas-envio-trabalho.php">
					<button type="button" class="btn btn-azul">NORMAS PARA SUBMISSÃO DE TRABALHOS</button>
				</a>
			</div>
			
			<br>
			<h4 id="pag9"></h4>
			<div class="pag pag9">
				<div style="position: relative; width: 100%; height: 0; padding-top: 56.2225%; padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden; border-radius: 8px; will-change: transform;">
					<iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;" src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGNyFbOwM8&#x2F;w15wOX557beMtqTv40cZuw&#x2F;view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
					</iframe>
				</div>
				<a href="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAGNyFbOwM8&#x2F;w15wOX557beMtqTv40cZuw&#x2F;view?utm_content=DAGNyFbOwM8&amp;utm_campaign=designshare&amp;utm_medium=embeds&amp;utm_source=link" target="_blank" rel="noopener">Palestra de Abertura - 14:00-15:30 Política Pública e Paradesporto Fábio Araújo SNPAR&#x2F;MESP Moderador Ciro Winckler UNIFESP</a> de ciro_winckler
			</div>
		</div>
	</div>
</div>
<?php
include 'includes/foot.php';