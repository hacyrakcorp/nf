<?php

class DeclarantControleur extends BaseControleur
{
    public function accueil()
    { //Affiche la vue authentification
        include $this->pathVue.'header.php';
        include $this->pathVue.'accueilDeclarant.php';
        include $this->pathVue.'footer.php';
    }
}