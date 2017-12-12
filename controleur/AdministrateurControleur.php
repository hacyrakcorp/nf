<?php

class AdministrateurControleur extends BaseControleur
{
	public function accueil()
	{ //Page acceuil Admin		
            include $this->pathVue.'header.php';
            include $this->pathVue.'accueilAdmin.php';
            include $this->pathVue.'footer.php';
	}	
}
?>