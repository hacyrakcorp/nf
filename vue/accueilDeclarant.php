<div class="declarant">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<nav class="tab-links izzi-tabs">
			<div class="container-fluid">
				<div class="navbar-header">	
					<a class="navbar-brand">
						<img src="<?php echo $this->pathWeb('images/logo_Ndf.png'); ?>" alt="logo" id="logo" class="rotating"/>
					</a>
					<a class="navbar-brand">Note de frais</a>
				</div>
				<ul class="nav navbar-nav">
					<li> <a class="tab-links__item is-active" href="#Acc">Accueil</a> </li>
					<li> <a class="tab-links__item" href="#NF">Création des fiches de frais</a> </li>
					<li> <a class="tab-links__item" href="#GNF">Gestion des fiches de frais</a> </li>
				</ul>
				<form class="navbar-form navbar-right inline-form" method="post" name='deconnexion' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=deconnexion">
					<input class="btn-primary" type="submit" value="Déconnexion">
				</form>
			</div>
		</nav>
	</nav>
	
	<div class="tab-content">
		<div class="tab-content__item is-active" id="Acc">
			<h1>Accueil</h1>
			
		</div>
		<div class="tab-content__item" id="NF">
			<h1>Création des fiches de frais</h1>
			<?php include('saisieNF.php');
			?>
		</div>
		<div class="tab-content__item" id="GNF">
			<h1>Gestion des fiches de frais</h1>
			<?php include('gestionNF.php');
			?>
		</div>
	</div>
</div>
		
<script src="../web/js/izzi-tabs.min.js"></script>
<script>
	var izziTabs = new IzziTabs('.izzi-tabs');
</script>	