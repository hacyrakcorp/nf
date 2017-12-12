<?php

class AuthentificationController extends BaseControleur
{
    public function login()
    { //Affiche la vue authentification
        include $this->pathVue.'header.php';
        include $this->pathVue.'formulaireLogin.php';
        include $this->pathVue.'footer.php';
    }

    public function traitementLogin()
    { //Vérification du login et du mot de passe
        $bdd = Connexion::getInstance();
        $mdp = $this->getPostParam('motdepasse');
        $login = $this->getPostParam('login');
        if (!empty($login) && !empty($mdp))
        { //champs login et mot de passe remplis
            $verification_login = Utilisateur::getByLogin($login);
            if ($verification_login != null)
            { //login ok
                $compte_bloque = $verification_login->getBloque();
                if (intval($compte_bloque) == 0)
                {//Le compte n'est pas bloqué
                    $verification_mdp = $verification_login->getMdp();
                    $sel='yolo42'; //A mettre en place plus tard 
                                    //(concaténation dans sha1)
                    $mdp_crypte = sha1($mdp);
                    $id = $verification_login->getId();
                    if ($verification_mdp == $mdp_crypte)
                    { //mdp OK
                        //Objet Statut
                        $statut = $verification_login->getStatut(); 
                        //Recupere ID du statut pour redirection
                        $statut = $statut->getId(); 
                        $this->setSessionParam('estAutenthifie', 'true');
                        $this->setSessionParam('statut', intval($statut));
                        $this->setSessionParam('id', intval($id));
                        //redirection vers la page autorisée
                        $this->redirect('index.php'); 
                    }
                    else
                    { //Erreur mdp	
                        // On inscrit la date dans historique_connection	
                        //faille si on change l'heure de l'ordi avec date
                        $date_tentative = date("Y-m-d"); 
                        $recup_histo = HistoConnection::getByUtilisateur($id);
                        $nb_tentative = $verification_login->getTentative_connection();
                        if ($recup_histo != null)
                        { //date tentative connexion existe		
                            $recup_date = $recup_histo->getDateTentative();
                            if ($recup_date==$date_tentative)								
                            {  //On augmente de 1 le nombre de tentative	
                                $nb_tentative += 1;
                                $verification_login->setTentative_connection($nb_tentative);
                                $verification_login->save();
                            }
                            else
                            { //Ré-initialise le nombre de tentative
                                $enregistrer_histo = new HistoConnection();
                                $enregistrer_histo->setUtilisateur($verification_login);
                                $enregistrer_histo->setDateTentative($date_tentative);
                                $enregistrer_histo->save();
                                $nb_tentative = 1;
                                $verification_login->setTentative_connection($nb_tentative);
                                $verification_login->save();
                            }
                        }
                        else
                        {//date tentative connexion n'existe pas	
                            $enregistrer_histo = new HistoConnection();
                            $enregistrer_histo->setUtilisateur($verification_login);
                            $enregistrer_histo->setDateTentative($date_tentative);
                            $enregistrer_histo->save();
                            $nb_tentative = 1;
                            $verification_login->setTentative_connection($nb_tentative);
                            $verification_login->save();
                        }				
                        // Si le nombre de tentative de la journée = 3 
                        // alors informe que le compte
                        // sera bloqué si 4 tentatives dans la journée
                        if ($nb_tentative == 3)
                        {
                                $this->redirect('index.php?erreur=16');
                        }
                        // Si le nombre de tentative de la journée = 4 
                        // alors bloqué
                        else if ($nb_tentative >= 4)
                        {
                                $this->redirect('index.php?erreur=17');
                        }
                        else
                        {//login + mdp pour sécurité
                                $this->redirect('index.php?erreur=1'); 
                        }
                    }
                }
                else
                {//compte_bloque
                        $this->redirect('index.php?erreur=17');
                }
            } 
            else 
            { //Erreur login
                    $this->redirect('index.php?erreur=1'); //login + mdp pour sécurité
            }
        }
        else
        { //erreur : remplir tout les champs
                $this->redirect('index.php?erreur=2');
        }
    }

    public function logout()
    { //Déconnexion
        $this->setSessionParam('estAutenthifie', 'false');
        $this->redirect('index.php');
    }
	
    public function motDePasseOublie()
    { //Affiche la vue mot de passe oublié (demande de l'e-mail)
        include $this->pathVue.'header.php';
        include $this->pathVue.'motDePasseOublieMail.php';
        include $this->pathVue.'footer.php';
    }
	
    public function traitementMotDePasseOublieEnvoyerCode()
    { //Envoyer un code de vérification pour pouvoir changer le mot de passe
        $bdd = Connexion::getInstance();		
        $mail = $this->getPostParam('recuperation_mail');
        if (!empty($mail))
        { //champs mail rempli
            $this->setSessionParam('recuperation_mail',$mail);
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
            { //Vérifie si mail est valide = XXXXXXX@xxx.xx
                $gestionMdp = Utilisateur::getByLogin($mail);
                if ($gestionMdp != False)
                { //mail présent dans la table utilisateur
                    $date_ancien_code = $gestionMdp->getDateExpiration();
                    $date_du_jour = date("Y-m-d");
                    if ($date_ancien_code < $date_du_jour OR $date_ancien_code == null)
                    { //Si la date expiration est null ou si elle est inférieure à celle du journée
                        // On renvoi un code
                        $date_expiration = date('Y-m-d', strtotime($date_du_jour) + (24 * 3600 * 2));
                        //Code de vérification généré aléatoirement
                        $code_verification = UtilitaireControleur::chaineAleatoire(10); 			
                        $gestionMdp->setDateExpiration($date_expiration);
                        $gestionMdp->setCode($code_verification);
                        //modifie dans la table utilisateur
                        $update = $gestionMdp->save(); 
                        //Structure du mail d'envoi du code
                        $sujet_mail = "Note de frais CFAI84 : modification du mot de passe";
                        $message_mail = "
                        <html>
                            <head>
                            </head>
                            <body>
                                Bonjour, <br>
                                Une demande pour réinitialiser le mot de passe 
                                de votre compte NF-CFAI84 à été effectuée.<br> 
                                Si vous n'êtes pas à l'origine de cette 
                                demande, vous pouvez ignorer ce mail.<br>
                                Pour définir un nouveau mot de passe, voici 
                                votre code de vérification : <br>
                                <center><b>".$code_verification."</b><center>
                                <br>
                                <Strong> Attention ! </strong>Ce code ne sera 
                                valable qu'une journée.
                                <br>
                                Ceci est un e-mail automatique, merci de ne pas 
                                répondre à cette adresse.
                            </body>
                        </html>";	//Message au format HTML.
                        $mailEnvoye = UtilitaireControleur::envoyerMail($this->getPostParam('recuperation_mail'), $sujet_mail, $message_mail);
                        if($mailEnvoye==True)
                        { //envoi du mail OK
                            $this->redirect('index.php?page=motDePasseOublieCode');
                        }
                        else
                        { //mail pas envoyer
                            $this->redirect('index.php?page=motDePasseOublie&erreur=5');
                        }
                    }
                    else
                    { //Le code à une date de validité correcte
                        $this->redirect('index.php?page=motDePasseOublieCode&info=7');
                    }	
                }
                else
                { //mail INCONNU de la table utilisateur
                    $this->redirect('index.php?page=motDePasseOublie&erreur=4');
                }
            }
            else 
            { //Si mail différent de XXXXXXX@xxx.xx
                $this->redirect('index.php?page=motDePasseOublie&erreur=3');
            }
        }
        else 
        { //erreur : remplir tout les champs
            $this->redirect('index.php?page=motDePasseOublie&erreur=2');
        }	
    }
	
    public function motDePasseOublieCode()
    { //Affiche la vue mot de passe oublié (code de vérification)
        include $this->pathVue.'header.php';
        include $this->pathVue.'motDePasseOublieCode.php';
        include $this->pathVue.'footer.php';
    }
	
    public function traitementMotDePasseOublieVerifierCode()
    { //Vérification du code de verification pour pouvoir changer le mot de passe
        $bdd = Connexion::getInstance();		
        if(!empty($this->getPostParam('code_verif')))
        { //champ code rempli
            $mail = $this->getSessionParam('recuperation_mail');
            $code_entre = $this->getPostParam('code_verif');
            //Recupere un objet Utilisateur
            $requete_verification = Utilisateur::getByLoginCode($mail, $code_entre);			
            if ($requete_verification!=null)
            { //Code OK
                $requete_verification->setConfirme(1); //Confirme l'entrée du code
                $requete_verification->save();
                $this->redirect('index.php?page=motDePasseOublieMdp');
            }
            else
            { //Code incorrect
                $this->redirect('index.php?page=motDePasseOublieCode&erreur=6');
            }
        }
        else
        { //erreur : remplir tout les champs
            $this->redirect('index.php?page=motDePasseOublieCode&erreur=2');
        }
    }
	
    public function motDePasseOublieMdp()
    { //Affiche la vue mot de passe oublié (changement du mdp)
        include $this->pathVue.'header.php';
        include $this->pathVue.'motDePasseOublieChangement.php';
        include $this->pathVue.'footer.php';		
    }
	
    public function traitementMotDePasseOublieModifierMdp()
    { //modification du mot de passe
        $bdd = Connexion::getInstance();
        $mdp = $this->getPostParam('modification_mdp');
        $mdp_confirme = $this->getPostParam('modification_mdp_confirme');
        $mail = $this->getSessionParam('recuperation_mail');
        if (!empty($mdp) && !empty($mdp_confirme))
        { //Sécurité pour être sûr qu'un code de vérification a été rentrer
            $MdpOublie = Utilisateur::getByLogin($mail); //Récupère un objet Utilisateur
            $verification_confirme = $MdpOublie->getConfirme();
            if(intval($verification_confirme)==1)
            { //Code de vérification OK
                if(!empty($mdp) && !empty($mdp_confirme))
                { //champs mdp et mdp confirme remplis
                    if($mdp===$mdp_confirme)
                    { //les 2 mdp correspondent
                        $sel='yolo42'; //A mettre en place plus tard 
                                        //(concaténation dans sha1)
                        $mdp = sha1($mdp); //Pour le hachage du mot de passe
                        //Recupere objet utilisateur
                        $utilisateur = Utilisateur::getByLogin($mail); 
                        $utilisateur->SetMdp($mdp);
                        $utilisateur->save(); //modifie le mdp
                        $this->redirect('index.php?info=1');
                    } 
                    else
                    { // les mdp sont différents
                        $this->redirect('index.php?page=motDePasseOublieMdp&erreur=8');
                    }
                }
                else
                { //erreur : remplir tout les champs
                    $this->redirect('index.php?page=motDePasseOublieMdp&erreur=2');
                }
            }	
            else
            { //Pas de code de vérification
                $this->redirect('index.php?page=motDePasseOublieMdp&erreur=7');
            }
        }
        else
        { //erreur : remplir tout les champs
            $this->redirect('index.php?page=motDePasseOublieMdp&erreur=2');
        }
    }
}

?>