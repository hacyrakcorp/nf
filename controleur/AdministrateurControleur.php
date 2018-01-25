<?php

class AdministrateurControleur extends BaseControleur {

    public function accueil() { //Page acceuil Admin		
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'accueilAdmin.php';
        include $this->pathVue . 'footer.php';
    }

    public function gestionUtilisateur() {
        $listeStatut = Statut::getAllListe();
        $listeService = Service::getAllListe();
        $listeUtilisateur = Utilisateur::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionUtilisateur.php';
        include $this->pathVue . 'footer.php';
    }

    public function creerUtilisateurAction() {
        $nom = $this->getPostParam('Nom');
        $prenom = $this->getPostParam('Prenom');
        $mail = $this->getPostParam('Mail');
        $mdp = $this->getPostParam('Mdp');
        $idStatut = $this->getPostParam('Statut');
        $statut = Statut::getById($idStatut);
        $idService = $this->getPostParam('Service');
        $service = Service::getById($idService);
        if (!empty($nom) AND ! empty($prenom) 
                AND ! empty($mail) AND ! empty($mdp)
                AND ! empty($statut) AND ! empty($service)) { //champs remplis
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
                $this->redirect('index.php?info=10&page=gestionUtilisateur');
            } else {
                //Erreur : l'utilisateur existe
                $this->redirect('index.php?erreur=19&page=gestionUtilisateur');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionUtilisateur');
        }
    }

    public function modifierUtilisateur() {
        $listeStatut = Statut::getAllListe();
        $listeService = Service::getAllListe();
        $utilisateur = Utilisateur::getById($this->getPostParam('id'));
        include $this->pathVue . 'modifierUtilisateur.php';
    }

    public function modifierUtilisateurAction() {
        $id = $this->getPostParam('id');
        $nom = $this->getPostParam('Nom');
        $prenom = $this->getPostParam('Prenom');
        $mail = $this->getPostParam('Mail');
        $mdp = $this->getPostParam('Mdp');
        $idStatut = $this->getPostParam('Statut');
        $statut = Statut::getById($idStatut);
        $idService = $this->getPostParam('Service');
        $service = Service::getById($idService);

        if (!empty($id) AND ! empty($nom) AND ! empty($prenom) 
                AND ! empty($mail) AND ! empty($mdp)
                AND ! empty($statut) AND ! empty($service)) { //champs remplis
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
                
                $this->redirect('index.php?info=10&page=gestionUtilisateur');
            } else {
                //Erreur : l'utilisateur existe
                $this->redirect('index.php?erreur=19&page=gestionUtilisateur');
            }
            
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionUtilisateur');
        }
    }

    public function suppressionUtilisateur() {
        $id = $this->getPostParam('id');
        $utilisateur = Utilisateur::getById($id);
        include $this->pathVue . 'suppressionUtilisateur.php';
    }

    public function suppressionUtilisateurAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $utilisateur = Utilisateur::getById($id);
            $utilisateur->delete();
            $this->redirect('index.php?info=9&page=gestionUtilisateur');
        } else {
            $this->redirect('index.php?erreur=18&page=gestionUtilisateur');
        }
    }
    
    public function gestionStatut() {
        $listeStatut = Statut::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionStatut.php';
        include $this->pathVue . 'footer.php';
    }
    
    public function creerStatutAction() {
        $libelle = $this->getPostParam('Libelle');
        if (!empty($libelle)) { //champs remplis
            //On vérifie que le statut n'existe pas
            $verifStatut = Statut::getByLibelle($libelle);
            if ($verifStatut == null) {
                //On enregistre l'utilisateur
                $statut = new Statut();
                $statut->setLibelle($libelle);
                $statut->save();
                $this->redirect('index.php?info=12&page=gestionStatut');
            } else {
                //Erreur : le statut existe
                $this->redirect('index.php?erreur=21&page=gestionStatut');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionStatut');
        }
    }
    
    public function suppressionStatut() {
        $id = $this->getPostParam('id');
        $statut = Statut::getById($id);
        include $this->pathVue . 'suppressionStatut.php';
    }

    public function suppressionStatutAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $statut = Statut::getById($id);
            $statut->delete();
            $this->redirect('index.php?info=13&page=gestionStatut');
        } else {
            $this->redirect('index.php?erreur=22&page=gestionStatut');
        }
    }
    
    public function gestionService() {
        $listeService = Service::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionService.php';
        include $this->pathVue . 'footer.php';
    }
    
    public function creerServiceAction() {
        $libelle = $this->getPostParam('Libelle');
        if (!empty($libelle)) { //champs remplis
            //On vérifie que le statut n'existe pas
            $verifService = Service::getByLibelle($libelle);
            if ($verifService == null) {
                //On enregistre l'utilisateur
                $service = new Service();
                $service->setLibelle($libelle);
                $service->save();
                $this->redirect('index.php?info=14&page=gestionService');
            } else {
                //Erreur : le statut existe
                $this->redirect('index.php?erreur=23&page=gestionService');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionService');
        }
    }
    
    public function suppressionService() {
        $id = $this->getPostParam('id');
        $service = Service::getById($id);
        include $this->pathVue . 'suppressionService.php';
    }

    public function suppressionServiceAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $service = Service::getById($id);
            $service->delete();
            $this->redirect('index.php?info=15&page=gestionService');
        } else {
            $this->redirect('index.php?erreur=24&page=gestionService');
        }
    }
    
    public function gestionEtat() {
        $listeEtat = Etat::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionEtat.php';
        include $this->pathVue . 'footer.php';
    }
    
    public function creerEtatAction() {
        $libelle = $this->getPostParam('Libelle');
        if (!empty($libelle)) { //champs remplis
            //On vérifie que le statut n'existe pas
            $verifEtat = Etat::getByLibelle($libelle);
            if ($verifEtat == null) {
                //On enregistre l'utilisateur
                $etat = new Etat();
                $etat->setLibelle($libelle);
                $etat->save();
                $this->redirect('index.php?info=16&page=gestionEtat');
            } else {
                //Erreur : le statut existe
                $this->redirect('index.php?erreur=25&page=gestionEtat');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionEtat');
        }
    }
    
    public function suppressionEtat() {
        $id = $this->getPostParam('id');
        $etat = Etat::getById($id);
        include $this->pathVue . 'suppressionEtat.php';
    }

    public function suppressionEtatAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $etat = Etat::getById($id);
            $etat->delete();
            $this->redirect('index.php?info=17&page=gestionEtat');
        } else {
            $this->redirect('index.php?erreur=26&page=gestionEtat');
        }
    }
    
    public function gestionTypeValeur() {
        $listeType = TypeValeur::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionTypeValeur.php';
        include $this->pathVue . 'footer.php';
    }
    
    public function creerTypeValeurAction() {
        $libelle = $this->getPostParam('Libelle');
        if (!empty($libelle)) { //champs remplis
            //On vérifie que le statut n'existe pas
            $verifType = TypeValeur::getByLibelle($libelle);
            if ($verifType == null) {
                //On enregistre l'utilisateur
                $type = new TypeValeur();
                $type->setLibelle($libelle);
                $type->save();
                $this->redirect('index.php?info=18&page=gestionTypeValeur');
            } else {
                //Erreur : le statut existe
                $this->redirect('index.php?erreur=27&page=gestionTypeValeur');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionTypeValeur');
        }
    }
    
    public function suppressionTypeValeur() {
        $id = $this->getPostParam('id');
        $type = TypeValeur::getById($id);
        include $this->pathVue . 'suppressionTypeValeur.php';
    }

    public function suppressionTypeValeurAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $type = TypeValeur::getById($id);
            $type->delete();
            $this->redirect('index.php?info=19&page=gestionTypeValeur');
        } else {
            $this->redirect('index.php?erreur=28&page=gestionTypeValeur');
        }
    }
    
    public function gestionNatureFrais() {
        $listeType = TypeValeur::getAllListe();
        $listeNature = NatureFrais::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuAdmin.php';
        include $this->pathVue . 'gestionNatureFrais.php';
        include $this->pathVue . 'footer.php';
    }
    
    public function creerNatureFraisAction() {
        $libelle = $this->getPostParam('Libelle');
        $idType = $this->getPostParam('TypeValeur');
        $type = TypeValeur::getById($idType);
        $unite = $this->getPostParam('Unite');
        if (!empty($libelle) AND !empty($idType) AND !empty($unite)) { //champs remplis
            //On vérifie que le statut n'existe pas
            $verifNature = NatureFrais::getByLibelle($libelle);
            if ($verifNature == null) {
                //On enregistre la nature
                $nature = new NatureFrais();
                $nature->setLibelle($libelle);
                $nature->setType_valeur($type);
                $nature->setUnite($unite);
                $nature->save();
                $this->redirect('index.php?info=20&page=gestionNatureFrais');
            } else {
                //Erreur : le statut existe
                $this->redirect('index.php?erreur=29&page=gestionNatureFrais');
            }
        } else { //Remplir tous les champs
            $this->redirect('index.php?erreur=2&page=gestionNatureFrais');
        }
    }
    
    public function suppressionNatureFrais() {
        $id = $this->getPostParam('id');
        $nature = NatureFrais::getById($id);
        include $this->pathVue . 'suppressionNatureFrais.php';
    }

    public function suppressionNatureFraisAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $nature = NatureFrais::getById($id);
            $nature->delete();
            $this->redirect('index.php?info=21&page=gestionNatureFrais');
        } else {
            $this->redirect('index.php?erreur=30&page=gestionNatureFrais');
        }
    }
    

}

?>