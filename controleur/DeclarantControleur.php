<?php

class DeclarantControleur extends BaseControleur {

    public function accueil() { //Affiche la vue authentification
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
            $this->redirect('index.php?info=?&page=listerNF');
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
                   
            // Parcours des checkbox et des valeurs associées.
            foreach ($tabNatureChoisie as $idNatureChoisie) { 
                echo "Id de la nature : " . $idNatureChoisie . ", valeur de la nature : " . $this->getPostParam('valeurNature' . $idNatureChoisie) . "<br/>";
                $valeur = $this->getPostParam('valeurNature' . $idNatureChoisie);
                $nature = NatureFrais::getById(intval($idNatureChoisie));
                $valeurFrais = new ValeurFrais();
                $valeurFrais->setId_ligne_frais($ligneFrais);
                $valeurFrais->setValeur(doubleval($valeur));
                $valeurFrais->setId_nature_frais($nature);
                $valeurFrais->save();
                var_dump($valeurFrais->getId_ligne_frais()->getId());
//Id null car ligneFrais pas setID vu avec var_dump (id à null)
//normal car autoincrémenter
//Il faut re-récupérer la ligne à partir de l'ID
//Comment avoir l'ID, comment re-récupérer cette ligne ?
                echo '<br/>';
                var_dump($valeurFrais->getId_nature_frais()->getId());
                echo '<br/>';
                var_dump($valeurFrais->getValeur());
                echo '<br/>';

//TAF:Redirection vers la modale possible pour ajouter plusieurs lignes en une fois???
            }
        } else { // Aucune checkbox cochée
            echo "<script>alert('Cocher au moins un frais.');</script>";
            //TAF:Redirection vers la modale 
        }
        exit;

        /*
        $tab_id_nature = $this->getPostParam('nature');
        if (!empty($tab_id_nature)) { //On vérifie qu'il y a des checkbox cochés           
//TAF : On vérifie que pour une checkbox cochées on a une valeur dans l'input
//Comment récupérer la valeur de l'input voulu ??
//Le mettre dans le for des valeurs d'une ligne??
            $valeur = $this->getPostParam('valeur'); //Générique : tous les input 'valeur' voir ajoutNF2.php
//Problème, on vérifie un seul input
//if (!empty($valeur){
            //On récup les données pour la ligne de frais
            $date = $this->getPostParam('date');
            $objet = $this->getPostParam('object');
            $lieu = $this->getPostParam('lieu');
            $id_NF = $this->getPostParam('id_NF');
            if (!empty($date) and ! empty($objet) and ! empty($lieu)) {
                $ligneFrais = new LigneNF();
                $ligneFrais->setDate_ligne($date);
                $ligneFrais->setObject($objet);
                $ligneFrais->setLieu($lieu);
                $ligneFrais->setId_note_frais($id_NF);
                //$ligneFrais->save();
            } else {//Remplir tout les champs
                $this->redirect('index.php?erreur=2&page=listerNF');
            }
            //On récup les valeurs contenue dans une ligne
            for ($i = 0; $i < sizeof($tab_id_nature); $i++) {
                $id_nature = $tab_id_nature[$i];
                $nature = NatureFrais::getById(intval($id_nature));
                $valeurFrais = new ValeurFrais();
                $valeurFrais->setId_ligne_frais($ligneFrais);
                $valeurFrais->setValeur(doubleval($valeur));
                $valeurFrais->setId($nature);
                //$valeurFrais->save();
//TAF:Redirection vers la modale possible pour ajouter plusieurs lignes en une fois???
            }
        } else {
            echo('Cocher une valeur.');
            exit();
        }*/
    }

    /*
      //Recupere toute les notes de frais d'un utilisateur
      public function recupereNFAll() {
      $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
      $id_utilisateur = $utilisateur->getId();
      $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
      $len = 0;
      $lenTab = count($verificationNF);
      $table = array();
      while ($len < $lenTab) {
      $ligne = $verificationNF[$len];
      $id = $ligne->getId();
      $mois_annee = $ligne->getMois_annee();
      $etat = $ligne->getId_etat();
      $libelle_etat = $etat->getLibelle();
      $table[$len] = [$id, $mois_annee, $libelle_etat];
      $len++;
      }
      //Trie de la table selon la date
      $i = 0;
      foreach ($table as $key => $value) {
      $tab_date[$i] = $value[1];
      $i++;
      }
      array_multisort($tab_date, SORT_DESC, $table);
      return $table;
      }

      //Recupere toute les notes de frais d'un utilisateur
      public function recupereLigneAll() {
      $ligneNF = NoteDeFrais::getById(35);
      $id_ligneNF = $ligneNF->getId();
      $recupLigne = LigneNF::getByNFAll($id_ligneNF);
      $len = 0;
      $lenTab = count($recupLigne);
      $table = array();
      while ($len < $lenTab) {
      $ligne = $recupLigne[$len];
      $id = $ligne->getId();
      $date_ligne = $ligne->getDate_ligne();
      $object = $ligne->getObject();
      $lieu = $ligne->getLieu();
      $montant = $ligne->getMontant();
      $table[$len] = [$id, $date_ligne, $object, $lieu, $montant];
      $len++;
      }
      //Trie de la table selon la date
      $i = 0;
      foreach ($table as $key => $value) {
      $tab_date[$i] = $value[1];
      $i++;
      }
      array_multisort($tab_date, SORT_DESC, $table);
      return $table;
      }

      //Recupere toute les notes de frais d'un utilisateur
      public function recupereNF() {
      $NF = NoteDeFrais::getById($this->getSessionParam('id_NF'));
      $id = $NF->getId();
      $mois_annee = $NF->getMois_annee();
      $table = [$id, $mois_annee];
      return $table;
      }

      //permet d'enregistrer une note de frais dans la base
      public function enregistrerNF() {
      $id = $this->getPostParam('Id_NF');
      $moisAnnee = $this->getPostParam('mois_annee_NF');
      $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
      if (!empty($moisAnnee)) { //le champs mois_année est rempli
      $enregistrerNF = NoteDeFrais::getById($id);
      // Verification que 1 NF/utilisateur/mois
      $id_utilisateur = $utilisateur->getId();
      $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
      if ($verificationNF != null) {//Il existe des NF pour cet utilisateur
      $erreur = false;
      foreach ($verificationNF as $item) {//Parcours le tableau
      $verificationDateNF = $item->getMois_annee();
      if ($verificationDateNF == $moisAnnee) {//La date existe déjà
      $erreur = true;
      }
      }
      if ($erreur == true) { //Si booléen à vrai alors pas save sinon save
      $this->redirect('index.php?erreur=18#Creer');
      } else {//Il n'y a aucun enregistrement pour cet utilisateur
      $etat = new Etat();
      $id_etat = $etat->getByLibelle("brouillon"); //Etat = brouillon
      if ($enregistrerNF != null) { //Modification d'une note de frais
      $enregistrerNF->setMois_annee($moisAnnee);
      $enregistrerNF->setId_utilisateur($utilisateur);
      $enregistrerNF->setId_etat($id_etat);
      } else { //Ajout d'une note de frais
      $enregistrerNF = new NoteDeFrais();
      $enregistrerNF->setMois_annee($moisAnnee);
      $enregistrerNF->setId_utilisateur($utilisateur);
      $enregistrerNF->setId_etat($id_etat);
      }
      $result = $enregistrerNF->save();
      if ($result === false) {//Date supérieur à date du jour
      $this->redirect('index.php?erreur=19#Creer');
      } else {//Fiche Créer
      $this->redirect('index.php?info=6#Creer');
      }
      }
      } else { //Remplir tout les champs
      $this->redirect('index.php?erreur=2#Creer');
      }
      }
      }

      public function gestionNF() {
      if ($this->getPostParam('Supprimer') != null) {//Bouton supprimer cliquer
      $id = $this->getPostParam('Supprimer');
      $noteDeFrais = NoteDeFrais::getById($id);
      if (!empty($id)) {
      $noteDeFrais->delete();
      $this->redirect('index.php?info=3#Lister');
      } else {
      $this->redirect('index.php?erreur=9#Lister');
      }
      } else if ($this->getPostParam('Soumettre') != null) {
      $id = $this->getPostParam('Soumettre');
      $noteDeFrais = NoteDeFrais::getById($id);
      if (!empty($id)) {
      $etat = new Etat();
      $etat_soumis = $etat->getByLibelle('soumise');
      $noteDeFrais->setId_etat($etat_soumis);
      $noteDeFrais->save();
      $this->redirect('index.php?info=4#Lister');
      } else {
      $this->redirect('index.php?erreur=10#Lister');
      }
      } else if ($this->getPostParam('Modifier') != null) {
      $id = $this->getPostParam('Modifier');
      $moisAnnee = $this->getPostParam('date_NF');
      $noteDeFrais = NoteDeFrais::getById($id);
      $utilisateur = Utilisateur::getById($this->getSessionParam('id'));
      if (!empty($id)) {
      $id_utilisateur = $utilisateur->getId();
      $verificationNF = NoteDeFrais::getByUtilisateurAll($id_utilisateur);
      if ($verificationNF != null) {//Il existe des NF pour cet utilisateur
      $erreur = false; //La Fiche Frais n'existe pas
      foreach ($verificationNF as $item) {//Parcours le tableau
      $verificationDateNF = $item->getMois_annee();
      if ($verificationDateNF == $moisAnnee) {
      $erreur = true; //La date existe déjà
      }
      }
      if ($erreur == true) { //Si booléen à vrai alors pas save sinon save
      $this->redirect('index.php?erreur=18#Lister');
      } else {//Modif de la date
      if ($noteDeFrais != null) { //Modif d'une note de frais
      $noteDeFrais->setMois_annee($moisAnnee);
      }
      $result = $noteDeFrais->save();
      if ($result === false) {//Date supérieur à date du jour
      $this->redirect('index.php?erreur=19#Lister');
      } else {//Fiche Modifier
      $this->redirect('index.php?info=2#Lister');
      }
      }
      } else {
      $this->redirect('index.php?erreur=10#Lister');
      }
      }
      /* else if ($this->getPostParam('Ajouter') != null) {
     * //Bouton ajouter cliquer
      }
      }
      } */
}
