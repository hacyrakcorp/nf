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
            if ($this->getGetParam('page') === 'deconnexion')
            {
                $authentificationController = new AuthentificationController();
                $authentificationController->logout();
            }
            else if($this->getGetParam('page') === null)
            { // Page d'accueil en fonction du statut
                if(intval($this->getSessionParam('statut')) === 1)
                {  //L'utilisateur est administrateur
                    $administrateurControleur = new AdministrateurControleur();
                    $administrateurControleur->accueil();
                } 
                else if(intval($this->getSessionParam('statut')) === 2)
                {  //L'utilisateur est déclarant salarié
                    $declarantControleur = new DeclarantControleur();
                    $declarantControleur->accueil();
                } 
            }
            else if($this->getGetParam('page') === 'enregistrer_nf')
            { //Enregistrement d'une fiche de frais
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->enregistrerNF();
            }
            else if ($this->getGetParam('page') === 'lister_nf')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->gestionNF();
            }
        }
    }
}
?>