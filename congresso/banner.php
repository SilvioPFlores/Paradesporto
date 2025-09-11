<?php
session_start();
include 'config/config.php';
include 'includes/head.php';
getHead($lang['congMenu'], $lang, 'home', 'css/css-banner.css');
include 'includes/menuBanner.php';
?>
<div class="container">
    <div class="divMed">
		<div data-bs-spy="scroll" data-bs-target="#navScroll" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="bg-body-tertiary p-3 rounded-2" tabindex="0">
			<div id="pt">
				<div class="pag">
					<img src="img/banner/pt-c.jpg">
					<div class="centro">
						<audio src="midia/pt-c.mpeg" type="audio/mpeg"  controls="controls"></audio>
					</div>
				</div> 
				<br>
				<div class="pag">
					<img src="img/banner/pt-a.jpg">
					<div class="centro">
						<audio src="midia/pt-a.mpeg" type="audio/mpeg"  controls="controls"></audio>
					</div>
				</div>
			</div>
			<br>
			<div id="lb">
				<h4>Libras</h4>
				<div class="pag">
					<video src="midia/vd-c.mp4" type="audio/mpeg"  controls="controls"></video>
				</div> 
				<br>
				<div class="pag">
					<video src="midia/vd-a.mp4" type="audio/mpeg"  controls="controls"></video>
				</div>
			</div> 
			<br>
			<div id="gr">
				<h4>Guarani</h4>
				<div class="pag ">
					<img src="img/banner/gr-c.jpg">
				</div> 
				<br>
				<div class="pag ">
					<img src="img/banner/gr-a.jpg">
				</div>
			</div> 
			<br>
			<div id="en">
				<h4>English</h4>
				<div class="pag">
					<img src="img/banner/en-c.jpg">
				</div> 
				<br>
				<div class="pag">
					<img src="img/banner/en-a.jpg">
				</div>
			</div>
			<br>
			<div id="es">
				<h4>Español</h4>
				<div class="pag">
					<img src="img/banner/es-c.jpg">
				</div>
				<br>
				<div class="pag">
					<img src="img/banner/es-a.jpg">
				</div>
			</div>
			<br>
			<div id="fr">
				<h4>Français</h4>
				<div class="pag">
					<img src="img/banner/fr-c.jpg">
				</div>
				<br>
				<div class="pag">
					<img src="img/banner/fr-a.jpg">
				</div>
			</div>
			<br>
		</div>
    </div>
</div>
<?php
include 'includes/foot.php';