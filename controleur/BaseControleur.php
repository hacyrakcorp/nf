<?php

//Permet la gestion des variables $_ et des chemins
//c'est ici que ce fera la gestion des injections sql
//c'est ici que ce fera la gestion des erreurs

class BaseControleur {

    protected $erreurMessage;
    protected $infoMessage;
    protected $pathVue;

    public function __construct() {
        $this->pathVue = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR;

        //Liste des information
        if ($this->getGetParam('info') == 1) {
            $this->infoMessage = 'Le mot de passe à bien été modifié.';
        } else if ($this->getGetParam('info') == 2) {
            $this->infoMessage = 'La fiche de frais est crée.';
        } else if ($this->getGetParam('info') == 3) {
            $this->infoMessage = 'La fiche de frais est modifiée.';
        } else if ($this->getGetParam('info') == 4) {
            $this->infoMessage = 'La note de frais est soumise à la comptabilité';
        } else if ($this->getGetParam('info') == 5) {
            $this->infoMessage = 'Chargement du fichier csv effectué';
        } else if ($this->getGetParam('info') == 6) {
            $this->infoMessage = 'Fiche de frais enregistrée';
        } else if ($this->getGetParam('info') == 7) {
            $this->infoMessage = 'Un code vous a déjà été renseigner aujourd\'hui. Utilisez le ici.';
        } else if ($this->getGetParam('info') == 8) {
            $this->infoMessage = 'La fiche de frais a été supprimée';
        } else if ($this->getGetParam('info') == 9) {
            $this->infoMessage = 'L\'utilisateur a été supprimé';
        } else if ($this->getGetParam('info') == 10) {
            $this->infoMessage = 'L\'utilisateur a été ajouté';
        } else if ($this->getGetParam('info') == 12) {
            $this->infoMessage = 'Le statut a été ajouté';
        } else if ($this->getGetParam('info') == 13) {
            $this->infoMessage = 'Le statut a été supprimé';
        } else if ($this->getGetParam('info') == 14) {
            $this->infoMessage = 'Le service a été ajouté';
        } else if ($this->getGetParam('info') == 15) {
            $this->infoMessage = 'Le service a été supprimé';
        } else if ($this->getGetParam('info') == 16) {
            $this->infoMessage = 'L\'état a été ajouté';
        } else if ($this->getGetParam('info') == 17) {
            $this->infoMessage = 'L\'état a été supprimé';
        } else if ($this->getGetParam('info') == 18) {
            $this->infoMessage = 'Le type de valeur a été ajouté';
        } else if ($this->getGetParam('info') == 19) {
            $this->infoMessage = 'Le type de valeur a été supprimé';
        } else if ($this->getGetParam('info') == 20) {
            $this->infoMessage = 'La nature du frais a été ajouté';
        } else if ($this->getGetParam('info') == 21) {
            $this->infoMessage = 'La nature du frais a été supprimé';
        } else if ($this->getGetParam('info') == 22) {
            $this->infoMessage = 'La ligne a été ajouté';
        } else if ($this->getGetParam('info') == 23) {
            $this->infoMessage = 'La ligne a été supprimé';
        } else if ($this->getGetParam('info') == 24) {
            $this->infoMessage = 'La ligne a été modifié';
        } else if ($this->getGetParam('info') == 25) {
            $this->infoMessage = 'Le tarif a été ajouté';
        } else if ($this->getGetParam('info') == 26) {
            $this->infoMessage = 'Le tarif a été supprimé';
        } 


        //Liste des erreurs
        if ($this->getGetParam('erreur') == 1) {
            $this->erreurMessage = 'Identifiants incorrects.';
        } else if ($this->getGetParam('erreur') == 2) {
            $this->erreurMessage = 'Veuillez remplir tous les champs.';
        } else if ($this->getGetParam('erreur') == 3) {
            $this->erreurMessage = 'Adresse mail non valide (XXXXXXX@xxx.xx).';
        } else if ($this->getGetParam('erreur') == 4) {
            $this->erreurMessage = 'Adresse mail inconnue.';
        } else if ($this->getGetParam('erreur') == 5) {
            $this->erreurMessage = 'Le mail n\'a pas pu être envoyé. Réessayer.';
        } else if ($this->getGetParam('erreur') == 6) {
            $this->erreurMessage = 'Le code de vérification est incorrect.';
        } else if ($this->getGetParam('erreur') == 7) {
            $this->erreurMessage = 'Valider d\'abord votre demande '
                    . 'avec le code de vérification qui '
                    . 'vous a été envoyé par mail.';
        } else if ($this->getGetParam('erreur') == 8) {
            $this->erreurMessage = 'Les mots de passe sont différents.';
        } else if ($this->getGetParam('erreur') == 9) {
            //$this->erreurMessage = 'Erreur de suppression de la note de frais';
            $this->erreurMessage = 'Une fiche de frais existe. '
                    . 'Veuillez la compléter.';
        } else if ($this->getGetParam('erreur') == 10) {
           // $this->erreurMessage = 'La fiche de frais n\'as pas pu être soumise';
            $this->erreurMessage = 'Impossible d\'enregistrer une date avenir.';
        } else if ($this->getGetParam('erreur') == 11) {
            $this->erreurMessage = 'Erreur de suppression de la note de frais.';
        } else if ($this->getGetParam('erreur') == 12) {
            $this->erreurMessage = 'La fiche de frais n\'as pas pu être soumise.';
            //$this->erreurMessage = 'Le chargement du fichier csv a échoué';
        } else if ($this->getGetParam('erreur') == 13) {
            $this->erreurMessage = 'Veuillez sélectionner des sessions à supprimer';
        } else if ($this->getGetParam('erreur') == 14) {
            $this->erreurMessage = 'Veuillez sélectionner des binomes à supprimer';
        } else if ($this->getGetParam('erreur') == 15) {
            $this->erreurMessage = 'Veuillez sélectionner des candidats à supprimer';
        } else if ($this->getGetParam('erreur') == 16) {
            $this->erreurMessage = 'Vous vous êtes déjà trompé(e) 3 fois aujourd\'hui. A la 4eme vous serez bloqué et devrez contacter l\'administrateur.';
        } else if ($this->getGetParam('erreur') == 17) {
            $this->erreurMessage = 'Votre compte est bloqué. Veuillez contacter l\'administrateur.';
        } else if ($this->getGetParam('erreur') == 18) {
            $this->erreurMessage = 'Erreur de suppression du déclarant';
        } else if ($this->getGetParam('erreur') == 19) {
            $this->erreurMessage = 'Le déclarant existe déjà, vérifier le mail';
        } else if ($this->getGetParam('erreur') == 21) {
            $this->erreurMessage = 'Le statut existe déjà';
        } else if ($this->getGetParam('erreur') == 22) {
            $this->erreurMessage = 'Erreur de suppression du statut';
        } else if ($this->getGetParam('erreur') == 23) {
            $this->erreurMessage = 'Le service existe déjà';
        } else if ($this->getGetParam('erreur') == 24) {
            $this->erreurMessage = 'Erreur de suppression du service';
        } else if ($this->getGetParam('erreur') == 25) {
            $this->erreurMessage = 'L\'état existe déjà';
        } else if ($this->getGetParam('erreur') == 26) {
            $this->erreurMessage = 'Erreur de suppression de l\'état';
        } else if ($this->getGetParam('erreur') == 27) {
            $this->erreurMessage = 'Le type de valeur existe déjà';
        } else if ($this->getGetParam('erreur') == 28) {
            $this->erreurMessage = 'Erreur de suppression du type de valeur';
        } else if ($this->getGetParam('erreur') == 29) {
            $this->erreurMessage = 'La nature du frais existe déjà';
        } else if ($this->getGetParam('erreur') == 30) {
            $this->erreurMessage = 'Erreur de suppression de la nature du frais';
        } else if ($this->getGetParam('erreur') == 31) {
            $this->erreurMessage = 'La ligne existe déjà';
        } else if ($this->getGetParam('erreur') == 32) {
            $this->erreurMessage = 'Erreur de suppression de la ligne de frais';
        } else if ($this->getGetParam('erreur') == 33) {
            $this->erreurMessage = 'Cocher au moins une valeur';
        } else if ($this->getGetParam('erreur') == 34) {
            $this->erreurMessage = 'Le tarif existe déjà';
        } else if ($this->getGetParam('erreur') == 35) {
            $this->erreurMessage = 'Erreur de suppression du tarif';
        }
    } 

    public function redirect($lien) { //redirection
        header('location: ' . $this->pathWeb($lien));
    }

    public function pathWeb($name) { //permet d'avoir le chemin du script
        return dirname($this->getServerParam('REQUEST_URI')) . '/' . $name;
    }

    //htmlspecialchars permet d'éviter les injections sql
    //=>enleve html qui peut être contenu dans la variable
    public function getSessionParam($name) {
        if (isset($_SESSION[$name])) {
            return htmlspecialchars($_SESSION[$name]);
        } else {
            return null;
        }
    }

    public function setSessionParam($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function getGetParam($name) {
        if (isset($_GET[$name])) {
            return htmlspecialchars($_GET[$name]);
        } else {
            return null;
        }
    }

    public function getPostParam($name) {
        if (isset($_POST[$name])) {
            //return htmlspecialchars($_POST[$name]);
            return $_POST[$name];
        } else {
            return null;
        }
    }
    public function setPostParam($name,$valeur) {
        $_POST[$name]=$valeur;
        if (isset($_POST[$name])) {
            //return htmlspecialchars($_POST[$name]);
            return $_POST[$name];
        } else {
            return null;
        }
    }

    public function getServerParam($name) {
        if (isset($_SERVER[$name])) {
            return htmlspecialchars($_SERVER[$name]);
        } else {
            return null;
        }
    }

}

?>