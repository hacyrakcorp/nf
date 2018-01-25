<?php

class AdministrateurControleur extends BaseControleur {

    public function accueil() { //Page acceuil Admin		
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'accueilAdmin.php';
        include $this->pathVue . 'footer.php';
    }

    public function gestionDeclarant() {
        $listeStatut = Statut::getAllListe();
        $listeService = Service::getAllListe();
        $listeDeclarant = Utilisateur::getAllDeclarant();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionDeclarant.php';
        include $this->pathVue . 'footer.php';
    }

    public function creerDeclarantAction() {
        $nom = $this->getPostParam('Nom');
        $prenom = $this->getPostParam('Prenom');
        $mail = $this->getPostParam('Mail');
        $mdp = $this->getPostParam('Mdp');
        $idStatut = $this->getPostParam('Statut');
        $statut = Statut::getById($idStatut);
        $idService = $this->getPostParam('Service');
        $service = Service::getById($idService);
        if (!empty($nom) OR ! empty($prenom) OR ! empty($mail) OR ! empty($mdp)
                OR ! empty($statut) OR ! empty($service)) { //champs remplis
            //On vérifie que l'utilisateur n'existe pas
            $utilisateur = Utilisateur::getByLogin($mail);
            if ($utilisateur == null) {
                $mdpCrypte = sha1($mdp);
                //On enregistre l'utilisateur
                $declarant = new Utilisateur();
                $declarant->setNom($nom);
                $declarant->setPrenom($prenom);
                $declarant->setLogin($mail);
                $declarant->setMdp($mdpCrypte);
                $declarant->setStatut($statut);
                $declarant->setService($service);
                $declarant->save();
                $this->redirect('index.php?info=10&page=gestionD');
            } else {
                //Erreur : l'utilisateur existe
                $this->redirect('index.php?erreur=19&page=gestionD');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionD');
        }
    }

    public function modifierDeclarant() {
        $listeStatut = Statut::getAllListe();
        $listeService = Service::getAllListe();
        $declarant = Utilisateur::getById($this->getPostParam('id'));
        include $this->pathVue . 'modifierDeclarant.php';
    }

    public function modifierDeclarantAction() {
        $id = $this->getPostParam('id');
        $nom = $this->getPostParam('Nom');
        $prenom = $this->getPostParam('Prenom');
        $mail = $this->getPostParam('Mail');
        $mdp = $this->getPostParam('Mdp');
        $idStatut = $this->getPostParam('Statut');
        $statut = Statut::getById($idStatut);
        $idService = $this->getPostParam('Service');
        $service = Service::getById($idService);

        if (!empty($id) OR ! empty($nom) OR ! empty($prenom) OR ! empty($mail) OR ! empty($mdp)
                OR ! empty($statut) OR ! empty($service)) { //champs remplis
            //On vérifie que l'utilisateur n'existe pas
            $declarant = Utilisateur::getById($id);
            $utilisateur = Utilisateur::getByLogin($mail);
            if ($utilisateur == null OR $utilisateur->getId() == $id)
            { 
                $declarant = new Utilisateur();
                $declarant->setId($id);
                $declarant->setNom($nom);
                $declarant->setPrenom($prenom);
                $declarant->setLogin($mail);
                //Le mode de passe est modifié
                if ($mdp != $declarant->getMdp()){
                    $mdpCrypte = sha1($mdp);
                    $declarant->setMdp($mdpCrypte);
                }
                $declarant->setStatut($statut);
                $declarant->setService($service);
                $declarant->save();
                
                $this->redirect('index.php?info=10&page=gestionD');
            } else {
                //Erreur : l'utilisateur existe
                $this->redirect('index.php?erreur=19&page=gestionD');
            }
            
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionD');
        }
    }

    public function suppressionDeclarant() {
        $id = $this->getPostParam('id');
        $declarant = Utilisateur::getById($id);
        include $this->pathVue . 'suppressionDeclarant.php';
    }

    public function suppressionDeclarantAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $declarant = Utilisateur::getById($id);
            $declarant->delete();
            $this->redirect('index.php?info=9&page=gestionD');
        } else {
            $this->redirect('index.php?erreur=18&page=gestionD');
        }
    }

}

?>