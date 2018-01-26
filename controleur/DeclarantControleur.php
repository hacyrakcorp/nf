<?php

class DeclarantControleur extends BaseControleur {

    public function accueil() { //Affiche la vue authentification
        $id_utilisateur = $this->getSessionParam('id');
        $utilisateur = Utilisateur::getById(intval($id_utilisateur));
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuDeclarant.php';
        include $this->pathVue . 'accueilDeclarant.php';
        include $this->pathVue . 'footer.php';
    }

    public function listerNF() {
        $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
        $id_utilisateur = $utilisateur->getId();
        $tabNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);

        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuDeclarant.php';
        include $this->pathVue . 'listerNF2.php';
        include $this->pathVue . 'footer.php';
    }

    public function creerNF() {
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'menuDeclarant.php';
        include $this->pathVue . 'creerNF.php';
        include $this->pathVue . 'footer.php';
    }

    public function creerNFAction() {
        $champsDate = $this->getPostParam('date_NF');
        if (!empty($champsDate)) { //le champs mois_année est rempli
            $etatBrouillon = Etat::getById(Etat::BROUILLON_ID);
            $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
            $id_utilisateur = $utilisateur->getId();
            // Verification que 1 NF/utilisateur/mois
            $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
            if ($verificationNF != null) {//Il existe des NF pour cet utilisateur
                $erreur = false;
                foreach ($verificationNF as $item) {//Parcours le tableau
                    $verificationDateNF = $item->getMois_annee();
                    if ($verificationDateNF == $champsDate) {//La date existe déjà
                        $erreur = true;
                    }
                }
                if ($erreur == true) { //La NF existe déjà
                    $this->redirect('index.php?erreur=9&page=creerNF');
                } else {//La NF n'existe pas
                    $noteDeFrais = new NoteDeFrais();
                    $noteDeFrais->setId_utilisateur($utilisateur);
                    $noteDeFrais->setId_etat($etatBrouillon);
                    $noteDeFrais->setMois_annee($this->getPostParam('mois_annee_NF'));
                    $result = $noteDeFrais->save();
                    
                    if ($result === false) {//Date supérieur à date du jour
                        $this->redirect('index.php?erreur=10&page=creerNF');
                    } else {//La NF est créer
                        $this->redirect('index.php?info=2&page=creerNF');
                    }
                }
            }
        } else { //Remplir tout les champs
            $this->redirect('index.php?erreur=2&page=creerNF');
        }
    }
    
    public function creerNFAction2() {
        $champsDate = $this->getPostParam('date_NF');
        if (!empty($champsDate)) { //le champs mois_année est rempli
            $etatBrouillon = Etat::getById(Etat::BROUILLON_ID);
            $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
            $id_utilisateur = $utilisateur->getId();
            // Verification que 1 NF/utilisateur/mois
            $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
            if ($verificationNF != null) {//Il existe des NF pour cet utilisateur
                $erreur = false;
                foreach ($verificationNF as $item) {//Parcours le tableau
                    $verificationDateNF = $item->getMois_annee();
                    if ($verificationDateNF == $champsDate) {//La date existe déjà
                        $erreur = true;
                    }
                }
                if ($erreur == true) { //La NF existe déjà
                    $this->redirect('index.php?erreur=9&page=creerNF');
                } else {//La NF n'existe pas
                    $noteDeFrais = new NoteDeFrais();
                    $noteDeFrais->setId_utilisateur($utilisateur);
                    $noteDeFrais->setId_etat($etatBrouillon);
                    $noteDeFrais->setMois_annee($champsDate);
                    $result = $noteDeFrais->save();
                    
                    if ($result === false) {//Date supérieur à date du jour
                        $this->redirect('index.php?erreur=10&page=creerNF');
                    } else {//La NF est créer
                        $this->redirect('index.php?info=2&page=creerNF');
                    }
                }
            }
        } else { //Remplir tout les champs
            $this->redirect('index.php?erreur=2&page=creerNF');
        }
    }

    public function modifierNF() {
        $id = $this->getPostParam('id');
        $noteDeFrais = NoteDeFrais::getById($id);
        include $this->pathVue . 'modifierNF.php';
    }

    public function modifierNFAction() {
        $champsDate = $this->getPostParam('date_NF');
        if (!empty($champsDate)) { //le champs mois_année est rempli
            $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
            $id_utilisateur = $utilisateur->getId();
            // Verification que 1 NF/utilisateur/mois
            $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
            if ($verificationNF != null) {//Il existe des NF pour cet utilisateur
                $erreur = false;
                foreach ($verificationNF as $item) {//Parcours le tableau
                    $verificationDateNF = $item->getMois_annee();
                    if ($verificationDateNF == $champsDate) {//La date existe déjà
                        $erreur = true;
                    }
                }
                if ($erreur == true) { //La NF existe déjà
                    $this->redirect('index.php?erreur=9&page=listerNF');
                } else {//La NF n'existe pas
                    $id = $this->getPostParam('id'); //Récupère id NF
                    $noteDeFrais = NoteDeFrais::getById($id);
                    $noteDeFrais->setMois_annee($this->getPostParam('date_NF'));
                    $result = $noteDeFrais->save();
                    if ($result === false) {//Date supérieure à date du jour
                        $this->redirect('index.php?erreur=10&page=listerNF');
                    } else {//La NF est modifiée
                        $this->redirect('index.php?info=3&page=listerNF');
                    }
                }
            }
        } else { //Remplir tout les champs
            $this->redirect('index.php?erreur=2&page=listerNF');
        }
    }

    public function suppressionNF() {
        $id = $this->getPostParam('id');
        $noteDeFrais = NoteDeFrais::getById($id);
        include $this->pathVue . 'suppressionNF.php';
    }

    public function suppressionNFAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $noteDeFrais = NoteDeFrais::getById($id);
            $noteDeFrais->delete();
            $this->redirect('index.php?info=8&page=listerNF');
        } else {
            $this->redirect('index.php?erreur=11&page=listerNF');
        }
    }

    public function soumettreNF() {
        $id = $this->getPostParam('id');
        $noteDeFrais = NoteDeFrais::getById($id);
        include $this->pathVue . 'soumettreNF.php';
    }

    public function soumettreNFAction() {
        $id = $this->getPostParam('id');
        if (!empty($id)) {
            $etatSoumis = Etat::getById(Etat::SOUMIS_ID);
            $noteDeFrais = NoteDeFrais::getById($id);
            $noteDeFrais->setId_etat($etatSoumis);
            $noteDeFrais->save();
            $this->redirect('index.php?info=4&page=listerNF');
        } else {
            $this->redirect('index.php?erreur=12&page=listerNF');
        }
    }

    public function voirNF() {
        $id = $this->getPostParam('id');
        $tabNF = NoteDeFrais::getById($id);
        $tabLigneNF = LigneNF::getByNFAll($tabNF->getId());
        include $this->pathVue . 'voirNF.php';
    }

    public function ajoutNF() {
        $id = $this->getPostParam('id');
        $tabNF = NoteDeFrais::getById($id);
        $tabLigneNF = LigneNF::getByNFAll($tabNF->getId());
        $tabNatureFrais = NatureFrais::getAllListe();
        if ($tabLigneNF != null) {
            foreach ($tabLigneNF as $ligne) {
                $idLigne = $ligne->getId();
                $totalLigne[] = LigneNF::totalLigne(intval($idLigne));   
            }
        }
        include $this->pathVue . 'ajoutNF2.php';
    }

    public function ajoutNFAction() {
        $tabNatureChoisie = $this->getPostParam('natureChoisie');
        //on vérifie que au moins une checkbox est coché.
        if (!empty($tabNatureChoisie)) {
            //On récup les données pour la ligne de frais
            $id_NF = $this->getPostParam('id_NF');
            $date = $this->getPostParam('date');
            $objet = $this->getPostParam('object');
            $lieu = $this->getPostParam('lieu');
            // Créer une nouvelle ligne de frais
            $ligneFrais = new LigneNF();
            $ligneFrais->setDate_ligne($date);
            $ligneFrais->setObject($objet);
            $ligneFrais->setLieu($lieu);
            $ligneFrais->setId_note_frais(NoteDeFrais::getById($id_NF));
            $ligneFrais->save();
            
            $ligneRecup = LigneNF::getById($ligneFrais->dernierID());
            // Parcours des checkbox et des valeurs associées.
            foreach ($tabNatureChoisie as $idNatureChoisie) { 
                $valeur = $this->getPostParam('valeurNature' . $idNatureChoisie);
                $nature = NatureFrais::getById(intval($idNatureChoisie));
                $valeurFrais = new ValeurFrais();
                $valeurFrais->setId_ligne_frais($ligneRecup);
                $valeurFrais->setValeur(doubleval($valeur));
                $valeurFrais->setId_nature_frais($nature);
                $valeurFrais->save();
//TAF:Redirection vers la modale possible pour ajouter plusieurs lignes en une fois???
            }
        } else { // Aucune checkbox cochée
            echo "<script>alert('Cocher au moins un frais.');</script>";
            //TAF:Redirection vers la modale 
        }
    }
}
