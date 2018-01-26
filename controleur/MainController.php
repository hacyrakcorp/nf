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
                else if(intval($this->getSessionParam('statut')) === 4)
                {  //L'utilisateur est comptable
                    $comptableControleur = new ComptableControleur();
                    $comptableControleur->accueil();
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
            else if ($this->getGetParam('page') === 'accueilDeclarant')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->accueil();
            }
            else if ($this->getGetParam('page') === 'modifierNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->modifierNF();
            }
            else if ($this->getGetParam('page') === 'modifierNFAction')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->modifierNFAction();
            }
            else if ($this->getGetParam('page') === 'creerNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->creerNF();
            }
            else if ($this->getGetParam('page') === 'creerNFAction')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->creerNFAction();
            }
            else if ($this->getGetParam('page') === 'creerNFAction2')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->creerNFAction2();
            }
            else if ($this->getGetParam('page') === 'listerNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->listerNF();
            }
            else if ($this->getGetParam('page') === 'suppressionNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->suppressionNF();
            }
            else if ($this->getGetParam('page') === 'suppressionNFAction')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->suppressionNFAction();
            }
            else if ($this->getGetParam('page') === 'soumettreNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->soumettreNF();
            }
            else if ($this->getGetParam('page') === 'soumettreNFAction')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->soumettreNFAction();
            }
            else if ($this->getGetParam('page') === 'voirNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->voirNF();
            }
            else if ($this->getGetParam('page') === 'ajoutNF')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->ajoutNF();
            }
            else if ($this->getGetParam('page') === 'ajoutNFAction')
            {
                $declarantControleur = new DeclarantControleur();
                $declarantControleur->ajoutNFAction();
            }
            else if ($this->getGetParam('page') === 'accueilAdmin')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->accueil();
            }
            else if ($this->getGetParam('page') === 'gestionUtilisateur')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionUtilisateur();
            }
            else if ($this->getGetParam('page') === 'suppressionUtilisateur')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionUtilisateur();
            }
            else if ($this->getGetParam('page') === 'suppressionUtilisateurAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionUtilisateurAction();
            }
            else if ($this->getGetParam('page') === 'creerUtilisateurAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerUtilisateurAction();
            }
            else if ($this->getGetParam('page') === 'modifierUtilisateur')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->modifierUtilisateur();
            }
            else if ($this->getGetParam('page') === 'modifierUtilisateurAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->modifierUtilisateurAction();
            }
            else if ($this->getGetParam('page') === 'filtrerAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->filtrerAction();
            }
            else if ($this->getGetParam('page') === 'gestionStatut')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionStatut();
            }
            else if ($this->getGetParam('page') === 'creerStatutAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerStatutAction();
            }
            else if ($this->getGetParam('page') === 'suppressionStatut')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionStatut();
            }
            else if ($this->getGetParam('page') === 'suppressionStatutAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionStatutAction();
            }
            else if ($this->getGetParam('page') === 'gestionService')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionService();
            }
            else if ($this->getGetParam('page') === 'creerServiceAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerServiceAction();
            }
            else if ($this->getGetParam('page') === 'suppressionService')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionService();
            }
            else if ($this->getGetParam('page') === 'suppressionServiceAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionServiceAction();
            }
            else if ($this->getGetParam('page') === 'gestionEtat')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionEtat();
            }
            else if ($this->getGetParam('page') === 'creerEtatAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerEtatAction();
            }
            else if ($this->getGetParam('page') === 'suppressionEtat')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionEtat();
            }
            else if ($this->getGetParam('page') === 'suppressionEtatAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionEtatAction();
            }
            else if ($this->getGetParam('page') === 'gestionTypeValeur')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionTypeValeur();
            }
            else if ($this->getGetParam('page') === 'creerTypeValeurAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerTypeValeurAction();
            }
            else if ($this->getGetParam('page') === 'suppressionTypeValeur')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionTypeValeur();
            }
            else if ($this->getGetParam('page') === 'suppressionTypeValeurAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionTypeValeurAction();
            }
            else if ($this->getGetParam('page') === 'gestionNatureFrais')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->gestionNatureFrais();
            }
            else if ($this->getGetParam('page') === 'accueilComptable')
            {
                $comptableControleur = new ComptableControleur();
                $comptableControleur->accueil();
            }
            else if ($this->getGetParam('page') === 'creerNatureFraisAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->creerNatureFraisAction();
            }
            else if ($this->getGetParam('page') === 'suppressionNatureFrais')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionNatureFrais();
            }
            else if ($this->getGetParam('page') === 'suppressionNatureFraisAction')
            {
                $administrateurControleur = new AdministrateurControleur();
                $administrateurControleur->suppressionNatureFraisAction();
            }
            
            
        }
    }
}
?>