<?php
//Controleur principal -> redirige vers la page autorisée
class MainController extends BaseControleur
{
    public function dispatch()
    {
        if($this->getSessionParam('estAutenthifie') === null || $this->getSessionParam('estAutenthifie') === 'false')
        { // Non connecté
            if($this->getGetParam('page') === null)
            { // Page d'accueil
                $authentificationController = new AuthentificationController();
                $authentificationController->login();
            }
            else if($this->getGetParam('page') === 'traitementLogin')
            { // Page d'accueil
                $authentificationController = new AuthentificationController();
                $authentificationController->traitementLogin();
            }
            else if($this->getGetParam('page') === 'motDePasseOublie')
            { //Page mot de passe oublié demande mail
                $authentificationController = new AuthentificationController();
                $authentificationController->motDePasseOublie(); // Affichage du formulaire
            }
            else if($this->getGetParam('page') === 'traitementMotDePasseOublieEnvoyerCode')
            { //Traitement pour envoyer un code de vérification
                $authentificationController = new AuthentificationController();
                $authentificationController->traitementMotDePasseOublieEnvoyerCode(); // Envoi de l'email
            }
			else if($this->getGetParam('page') === 'motDePasseOublieCode')
            { //Page mot de passe oublié code de vérification
                $authentificationController = new AuthentificationController();
                $authentificationController->motDePasseOublieCode(); // Affichage du formulaire
            }
			else if($this->getGetParam('page') === 'traitementMotDePasseOublieVerifierCode')
            { //Page mot de passe oublié code de vérification
                $authentificationController = new AuthentificationController();
                $authentificationController->traitementMotDePasseOublieVerifierCode(); // Vérifie code
            }
			else if ($this->getGetParam('page') === 'motDePasseOublieMdp')
			{ //Page mot de passe oublié changement MDP
				$authentificationController = new AuthentificationController();
                $authentificationController->motDePasseOublieMdp(); // Affichage du formulaire
			}
			else if ($this->getGetParam('page') === 'traitementMotDePasseOublieModifierMdp')
			{ //Page mot de passe oublié changement MDP
				$authentificationController = new AuthentificationController();
                $authentificationController->traitementMotDePasseOublieModifierMdp(); // Modifie MDP
			}
			
        }
        else
        { // Connecté
            if($this->getGetParam('page') === null)
            { // Page d'accueil en fonction du statut
                if(intval($this->getSessionParam('statut')) === 1)
                {  //L'utilisateur est administrateur
					$administrateurControleur = new AdministrateurControleur();
					$administrateurControleur->accueil();
                } 
            }
			if ($this->getGetParam('page') === 'traitementJury')
			{ //Page enregistrer jury (ajouter ou modifier)
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->enregistrerJury();
			}
			else if ($this->getGetParam('page') === 'traitementCandidat')
			{ //Page enregistrer candidat (ajouter ou modifier)
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->enregistrerCandidat();
			}
			else if ($this->getGetParam('page') === 'supprimerJury')
			{ //Page supprimer jury
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerJury();
			}
			else if ($this->getGetParam('page') === 'supprimerCandidat')
			{ //Page supprimer candidat
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerCandidat();
			}			
			else if ($this->getGetParam('page') === 'reset')
			{ //Page ré-initialise
				$this->redirect('index.php');					
			}
			else if ($this->getGetParam('page') === 'traitementTableau')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerSelection();
			}
			else if ($this->getGetParam('page') === 'filtrerTableau')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->filtrerOption();
			}
			else if ($this->getGetParam('page') === 'deconnexion')
			{
				$authentificationController = new AuthentificationController();
				$authentificationController->logout();
			}
			else if ($this->getGetParam('page') === 'chargercsv')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->chargercsv();
			}
			else if ($this->getGetParam('page') === 'traitementSessions')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->enregistrerSession();
			}
			else if ($this->getGetParam('page') === 'supprimerSessions')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerSelectionSession();
			}
			else if ($this->getGetParam('page') === 'traitementBinome')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->enregistrerBinome();
			}
			else if ($this->getGetParam('page') === 'supprimerBinome')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerBinome();
			}
			else if ($this->getGetParam('page') === 'traitementGroupe')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->enregistrerGroupeCandidat();
			}
			else if ($this->getGetParam('page') === 'supprimerGroupe')
			{
				$administrateurControleur = new AdministrateurControleur();
				$administrateurControleur->supprimerGroupe();
			}
			else if ($this->getGetParam('page') === 'traitementEpreuve')
			{
				$JuryControleur = new JuryControleur();
				$JuryControleur->chargerSession();
			}
			
        }
    }

    /*public function accueilJury()
    {
        include $this->pathVue.'header.php';
        include $this->pathVue.'accueilJury.php';
        include $this->pathVue.'footer.php';
    }*/

    public function accueilCandidat()
    {
        include $this->pathVue.'header.php';
        include $this->pathVue.'accueilCandidat.php';
        include $this->pathVue.'footer.php';
    }
	
}
?>