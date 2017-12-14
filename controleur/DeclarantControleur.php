<?php

class DeclarantControleur extends BaseControleur {

    public function accueil() { //Affiche la vue authentification
        include $this->pathVue . 'header.php';
        include $this->pathVue . 'accueilDeclarant.php';
        include $this->pathVue . 'footer.php';
    }
    
    //Recupere toute les notes de frais d'un utilisateur
    public function recupereNF(){
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
            var_dump($etat);
            //$libelle_etat = je n'arrive pas à récupérer 
            // * le libellé de l'etat ici;
            $table[$len] = [$id, $mois_annee, $etat];
            $len++;
        }
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
                    var_dump($verificationDateNF);
                    var_dump($moisAnnee);
                    var_dump($erreur);
                    if ($verificationDateNF == $moisAnnee) {//La date existe déjà
                        $erreur = true;
                    }
                }
                if ($erreur == true) { //Si booléen à vrai alors pas save sinon save
                    $this->redirect('index.php?erreur=18#Creer');
                } else {//Il n'y a aucun enregistrement pour cet utilisateur
                    if ($enregistrerNF != null) { //Modification d'une note de frais
                        $enregistrerNF->setMois_annee($moisAnnee);
                        $enregistrerNF->setId_utilisateur($utilisateur);
                    } else { //Ajout d'une note de frais
                        $enregistrerNF = new NoteDeFrais();
                        $enregistrerNF->setMois_annee($moisAnnee);
                        $enregistrerNF->setId_utilisateur($utilisateur);
                    }
                    $result = $enregistrerNF->save();
                    if ($result === false) {//Date supérieur à date du jour
                        $this->redirect('index.php?erreur=19#Creer');
                    } else {//Fiche Créer
                        $this->redirect('index.php?info=6#Creer');
                    }
                }
            } else {//Il n'y a pas de fiche de frais
                if ($enregistrerNF != null) { //Modification d'une note de frais
                    $enregistrerNF->setMois_annee($moisAnnee);
                    $enregistrerNF->setId_utilisateur($utilisateur);
                } else { //Ajout d'une note de frais
                    $enregistrerNF = new NoteDeFrais();
                    $enregistrerNF->setMois_annee($moisAnnee);
                    $enregistrerNF->setId_utilisateur($utilisateur);
                }
                $enregistrerNF->save();
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
