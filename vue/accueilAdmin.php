<div class="admin">
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
					<li> <a class="tab-links__item" href="#GdU">Gestion des utilisateurs</a> </li>
					<li> <a class="tab-links__item" href="#Param">Paramètres</a> </li>
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
		<div class="tab-content__item" id="GdU">
			<h1>Gestion des utilisateurs</h1>
		</div>
		<div class="tab-content__item" id="Param">
			<h1>Paramètres</h1>
		</div>
	</div>
</div>
		
<script src="../web/js/izzi-tabs.min.js"></script>
<script>
	var izziTabs = new IzziTabs('.izzi-tabs');
</script>	
	
		