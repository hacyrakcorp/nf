<?php

class DeclarantControleur extends BaseControleur {

    public function accueil() { //Affiche la vue authentification
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'accueilDeclarant.php';
        include $this->pathVue . 'footer.php';
    }

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
            if (empty($this->getSessionParam('id_NF'))) { //création NF
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
                } else {//Il n'y a pas de fiche de frais
                    $etat = new Etat();
                    $id_etat = $etat->getById(1); //Etat = brouillon
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
                    $enregistrerNF->save();
                    if ($result === false) {//Date supérieur à date du jour
                        $this->redirect('index.php?erreur=19#Creer');
                    } else {//Fiche Créer
                        $this->redirect('index.php?info=6#Creer');
                    }
                }
            } else { //modif NF
                $id_NF = $this->getSessionParam('id_NF');
                $enregistrerNF = NoteDeFrais::getById($id_NF);
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
                    } else {//Modif de la date
                        if ($enregistrerNF != null) { //Modif d'une note de frais
                            $enregistrerNF->setMois_annee($moisAnnee);
                            $enregistrerNF->setId_utilisateur($utilisateur);
                        }
                        $result = $enregistrerNF->save();
                        if ($result === false) {//Date supérieur à date du jour
                            $this->setSessionParam('id_NF', null);
                            $this->redirect('index.php?erreur=19#Creer');
                        } else {//Fiche Modifier
                            $this->setSessionParam('id_NF', null);
                            $this->redirect('index.php?info=2#Creer');
                        }
                    }
                }
            }
        } else { //Remplir tout les champs
            $this->redirect('index.php?erreur=2#Creer');
        }
    }

    public function gestionNF() {
        $id = $this->getPostParam('id');
        $noteDeFrais = NoteDeFrais::getById($id);
        if ($this->getPostParam('Ajouter') != null) {//Bouton ajouter cliquer
            
            
        } else if ($this->getPostParam('Soumettre') != null) {//Bouton soumettre cliquer
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
        } else if ($this->getPostParam('Modifier') != null) {//Bouton modifier cliquer
            $id_NF = $this->getPostParam('Modifier');
            $this->setSessionParam('id_NF', $id_NF);
            $this->redirect('index.php#Creer');
        } else if ($this->getPostParam('Supprimer') != null) {//Bouton supprimer cliquer
            $id = $this->getPostParam('Supprimer');
            $noteDeFrais = NoteDeFrais::getById($id);
            if (!empty($id)) {
                $noteDeFrais->delete();
                $this->redirect('index.php?info=3#Lister');
            } else {
                $this->redirect('index.php?erreur=9#Lister');
            }
        }
    }

}
