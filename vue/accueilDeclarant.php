<div class="declarant">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="main-navbar">
	<nav class="tab-links izzi-tabs">
            <div class="container-fluid">
		<div class="navbar-header">	
                    <a class="navbar-brand">
			<img src="<?php echo $this->pathWeb('images/logo_Ndf.png'); ?>" alt="logo" id="logo" class="rotating"/>
                    </a>
                </div>
		<ul class="nav navbar-nav">
                    <li> <a class="tab-links__item is-active" href="#Acc">Accueil</a> </li>
                    <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Note de frais
                            <span class="caret"></span></a>
			<ul class="dropdown-menu">
                            <li> <a class="tab-links__item" href="#Lister">Lister</a> </li>
                            <li> <a class="tab-links__item" href="#Creer">Créer</a> </li>
                        </ul>
                    </li>
		</ul>
		<form class="navbar-form navbar-right inline-form" method="post" name='deconnexion' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=deconnexion">
                    <input class="btn-primary" type="submit" value="Déconnexion">
		</form>
            </div>
        </nav>
    </nav>
	
    <div class="tab-content">
        <div class="tab-content__item is-active" id="Acc">
            <h1>ACCUEIL</h1>
	</div>
            <div class="tab-content__item" id="Lister">
                <h1>LISTE FICHES DE FRAIS</h1>
                    <?php include('listerNF.php'); ?>
            </div>
            <div class="tab-content__item" id="Creer">
		<h1>SAISIE FICHE DE FRAIS</h1>
                    <?php include('creerNF.php'); ?>	
            </div>
    </div>
</div>
		
<script src="../web/js/izzi-tabs.min.js"></script>
<script>
	var izziTabs = new IzziTabs('.izzi-tabs');
</script>

<!-- Script qui rend le body responsive
Le padding-top s'adapte à la taille de la navbar!-->
<script>
 $(window).resize(function () {
               $('body').css('padding-top', parseInt($('#main-navbar').css("height"))-50);
            });
 
            $(window).load(function () {
               $('body').css('padding-top', parseInt($('#main-navbar').css("height"))-50);        
});
</script>