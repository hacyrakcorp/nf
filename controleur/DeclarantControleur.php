<?php

class DeclarantControleur extends BaseControleur
{
    public function accueil()
    { //Affiche la vue authentification
        include $this->pathVue.'header.php';
        include $this->pathVue.'accueilDeclarant.php';
        include $this->pathVue.'footer.php';
    }
    
    public function enregistrerNF()
    { //permet d'enregistrer une note de frais dans la base
        $id = $this->getPostParam('Id_NF');
        $moisAnnee = $this->getPostParam('mois_annee_NF');
        $id_utilisateur = Utilisateur::getById($this->getSessionParam('id'));
        if (!empty($moisAnnee))
        { //le champs mois_année est rempli
            $enregistrerNF = NoteDeFrais::getById($id);
            if ($enregistrerNF != null)
            { //Modification d'une note de frais
                $enregistrerNF->setMois_annee($moisAnnee);
                $enregistrerNF->setId_utilisateur($id_utilisateur);
            }
            else
            { //Ajout d'une note de frais
                $enregistrerNF = new NoteDeFrais();
                $enregistrerNF->setMois_annee($moisAnnee);
                $enregistrerNF->setId_utilisateur($id_utilisateur);
            }
            $enregistrerNF->save();
            // OK pensez à vérifier que pour un utilisateur il n'y a qu'une
            //fiche de frais
            
        }
        else
        { //Remplir tout les champs
            $this->redirect('index.php?erreur=2#Creer');
        }
    }
}