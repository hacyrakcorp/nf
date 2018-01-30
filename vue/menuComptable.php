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
                    <li> <a class="tab-links__item is-active" href="<?php echo $this->getServerParam('PHP_SELF') ?>?page=accueilComptable">Accueil</a> </li>
                    <li> <a class="tab-links__item is-active" href="<?php echo $this->getServerParam('PHP_SELF') ?>?page=tableauBord">Tableau de bord</a> </li>
                    <li> <a class="tab-links__item is-active" href="<?php echo $this->getServerParam('PHP_SELF') ?>?page=tarifKm">Gestion tarif Km</a> </li>
                    
                </ul>
                <form class="navbar-form navbar-right inline-form" method="post" name='deconnexion' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=deconnexion">
                    <input class="btn-primary" type="submit" value="Déconnexion">
                </form>
            </div>
        </nav>
    </nav>
</div>

<script src="../web/js/izzi-tabs.min.js"></script>
<script>
    var izziTabs = new IzziTabs('.izzi-tabs');
</script>

<!-- Script qui rend le body responsive
Le padding-top s'adapte à la taille de la navbar!-->
<script>
    $(window).resize(function () {
        $('body').css('padding-top', parseInt($('#main-navbar').css("height")) - 50);
    });

    $(window).load(function () {
        $('body').css('padding-top', parseInt($('#main-navbar').css("height")) - 50);
    });
</script>