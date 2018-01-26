<?php

class ComptableControleur extends BaseControleur {

    public function accueil() { //Affiche la vue comptabilité
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'accueilComptable.php';
        include $this->pathVue . 'footer.php';
    }
}