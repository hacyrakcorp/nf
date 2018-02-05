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
        if (!empty($mois_annee) AND ! empty($tarif)) { //Champs ok
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
        $tabNFSoumis = NoteDeFrais::getByEtat(Etat::SOUMIS_ID);
        $tabNFEnCours = NoteDeFrais::getByEtat(Etat::ENCOURS_ID);
        $tabNFTraite = NoteDeFrais::getByEtat(Etat::TRAITER_ID);
        $tabNFAll = NoteDeFrais::getAllListe();
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuComptable.php';
        include $this->pathVue . 'tableauBord.php';
        include $this->pathVue . 'footer.php';
    }

    public function tableauNFAction() {
        if (!empty($this->getPostParam('Traiter'))) {//clique sur bouton ajouter lignes
            $id = $this->getPostParam('Traiter');
            $this->setSessionParam('idNF', $id);
        } else {//permet de revenir sur la page lors de la gestion de la ligne
            $id = $this->getSessionParam('idNF');
        }
        $tabNF = NoteDeFrais::getById($id);
        $tabLigneNF = LigneNF::getByNFAll($tabNF->getId());
        $tabLigneOM = LigneOM::getByNFAll($tabNF->getId());
        $tabReglement = HistoReglement::getByNoteFrais($id);
        $totalOM = NoteDeFrais::totalLigneOM($id);
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

        if (!empty($idNF) AND ! empty($rapport) AND ! empty($idCodeAnalytique) AND ! empty($affaire) AND ! empty($montant)) { //les champs sont remplis
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

    public function reglementAction() {
        $dateReglement = $this->getPostParam('regleLe');
        $modeReglement = $this->getPostParam('reglement');
        $idNF = $this->getPostParam('id_NF');
        if (!empty($dateReglement) AND ! empty($modeReglement)
                AND !empty($idNF)) {
            if ($modeReglement == "Cheque") {
                $numCheque = $this->getPostParam('numero_cheque');
                $banque = $this->getPostParam('input_banque');
                if (!empty($numCheque) AND ! empty($banque)) {
                    $nf = NoteDeFrais::getById($idNF);
                    $nf->setMode_reglement($modeReglement);
                    $nf->setBanque($banque);
                    $nf->setNumero_cheque($numCheque);
                    $nf->save();
                    $histoReglement = new HistoReglement();
                    $histoReglement->setDate_reglement($dateReglement);
                    $histoReglement->setId_note_frais($nf);
                    $histoReglement->save();
                    $this->redirect("index.php?info=27&page=tableauNFAction");
                } else { //Remplir tout les champs
                    $this->redirect("index.php?erreur=2&page=tableauNFAction");
                }
            } else { //Mode de reglement = Espece
                $nf = NoteDeFrais::getById($idNF);
                $nf->setMode_reglement($modeReglement);
                $nf->save();
                $histoReglement = new HistoReglement();
                $histoReglement->setDate_reglement($dateReglement);
                $histoReglement->setId_note_frais($nf);
                $histoReglement->save();
                $this->redirect("index.php?info=27&page=tableauNFAction");
            }
        } else { //Remplir tout les champs
            $this->redirect("index.php?erreur=2&page=tableauNFAction");
        }
    }
    
    public function modifierEtat(){
        $id = $this->getPostParam('id');
        $noteDeFrais = NoteDeFrais::getById($id);
        $listeEtat = Etat::getAllListe();
        include $this->pathVue.'modifierEtat.php';
    }
    
    public function modifierEtatAction() {
        $etat = Etat::getById($this->getPostParam('etat'));      
        $nf = NoteDeFrais::getById($this->getPostParam('idNF'));
        $nf->setId_etat($etat);
        $nf->save();
        $this->redirect("index.php?info=&page=tableauNFAction");
    }

}
