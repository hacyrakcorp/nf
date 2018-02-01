<?php

class ComptableControleur extends BaseControleur {

    public function accueil() { //Affiche la vue comptabilité
        $id_utilisateur = $this->getSessionParam('id');
        $utilisateur = Utilisateur::getById(intval($id_utilisateur));
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'accueilComptable.php';
        include $this->pathVue . 'footer.php';
    }

    public function tarifKm() {
        $listeTarif = Preference::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'tarifKm.php';
        include $this->pathVue . 'footer.php';
    }

    public function creerTarifAction() {
        $mois_annee = $this->getPostParam('mois_annee');
        $tarif = $this->getPostParam('tarif');
        if (!empty($mois_annee) AND ! empty($tarif)) 
        { //Champs ok
            //on vérifie que le mois existe pas
            $verifTarif = Preference::getByMois_annee($mois_annee);
            if ($verifTarif == null) {
                 $unTarif = new Preference();
                 $unTarif->setMois_annee($mois_annee);
                 $unTarif->setTarif_km($tarif);
                 $unTarif->save();
                 $this->redirect('index.php?info=25&page=tarifKm'); //mettre info
            } else {
                //erreur : le mois existe deja
                $this->redirect('index.php?erreur=34&page=tarifKm');
            }
        } else {
            //erreur : remplir les champs
            $this->redirect('index.php?erreur=2&page=tarifKm');
        }
    }

    public function suppressionTarif() {
        $mois_annee = $this->getPostParam('mois_annee');
        $tarif = Preference::getByMois_annee($mois_annee);
        include $this->pathVue . 'suppressionTarif.php';
    }

    public function suppressionTarifAction() {
        $mois_annee = $this->getPostParam('mois_annee');
        if (!empty($mois_annee)) {
            $tarif = Preference::getByMois_annee($mois_annee);
            $tarif->delete();
            $this->redirect('index.php?info=26&page=tarifKm');
        } else {
            $this->redirect('index.php?erreur=35&page=tarifKm');
        }
    }
    
    public function tableauBord() {
        $tabNF = NoteDeFrais::getByEtat(Etat::SOUMIS_ID);
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'tableauBord.php';
        include $this->pathVue . 'footer.php';
    }
    public function tableauNFAction() {
        if (!empty($this->getPostParam('Traiter')))
        {//clique sur bouton ajouter lignes
            $id = $this->getPostParam('Traiter');
            $this->setSessionParam('idNF', $id);
        } else 
        {//permet de revenir sur la page lors de la gestion de la ligne
            $id = $this->getSessionParam('idNF');
        }
        $tabNF = NoteDeFrais::getById($id);
        $tabLigneNF = LigneNF::getByNFAll($tabNF->getId());
        $tabLigneOM = LigneOM::getByNFAll($tabNF->getId());
        $tabNatureFrais = NatureFrais::getAllListe();
        $tabCodeAnalytique = CodeAnalytique::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'traitementNF.php';
        include $this->pathVue . 'footer.php';
    }
    public function traitementNFAction() {
        //Recup les inputs
        $idNF = $this->getPostParam('id_NF');
        $rapport = $this->getPostParam('rapport');
        $idCodeAnalytique = $this->getPostParam('code_analytique');
        $affaire = $this->getPostParam('affaire');
        $montant = $this->getPostParam('montant');
        
        if(!empty($idNF) AND 
                !empty($rapport) AND 
                !empty($idCodeAnalytique) AND
                !empty($affaire) AND
                !empty($montant))
        { //les champs sont remplis
            $NF = NoteDeFrais::getById($idNF);
            $codeAnalytique = CodeAnalytique::getById($idCodeAnalytique);
            $ligneOM = new LigneOM();
            $ligneOM->setId_note_frais($NF);
            $ligneOM->setId_code_analytique($codeAnalytique);
            $ligneOM->setNumero_rapport($rapport);
            $ligneOM->setAffaire($affaire);
            $ligneOM->setMontant($montant);
            $ligneOM->save();
            $this->redirect("index.php?info=22&page=tableauNFAction");
        } else { //Remplir tout les champs
            $this->redirect("index.php?erreur=2&page=tableauNFAction");
        }
        
    }

}
