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
				$verification_mdp = $verification_login->getMdp();
				$sel='yolo42'; //A mettre en place plus tard (concaténation dans sha1)
				$mdp_crypte = sha1($mdp);
				$id = $verification_login->getId();
				if ($verification_mdp == $mdp_crypte)
				{ //mdp OK
					$statut = $verification_login->getStatut();
					$this->setSessionParam('estAutenthifie', 'true');
					$this->setSessionParam('statut', intval($statut));
					$this->setSessionParam('id', intval($id));
					$this->redirect('index.php'); //redirection vers la page autorisée
				}
				else
				{ //Erreur mdp	
					// On inscrit la date dans historique_connection					
					$date_tentative = date("Y-m-d"); //faille si on change l'heure de l'ordi
					$recup_histo = HistoConnection::getByUtilisateur($id);
					$nb_tentative = $verification_login->getTentative_connection();
					if ($recup_histo != null)
					{		
							$recup_date = $recup_histo->getDateTentative();
							if ($recup_date==$date_tentative)								
							{  //On augmente de 1 le nombre de tentative	
								 $nb_tentative += 1;
								 $verification_login->setTentative_connection($nb_tentative);
								 $verification_login->save();
							}
							else
							{
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
					{
						$enregistrer_histo = new HistoConnection();
						$enregistrer_histo->setUtilisateur($verification_login);
						$enregistrer_histo->setDateTentative($date_tentative);
						$enregistrer_histo->save();
						$nb_tentative = 1;
						$verification_login->setTentative_connection($nb_tentative);
						$verification_login->save();
					}				
					// Si le nombre de tentative de la journée = 3 alors informe que le compte
					// sera bloqué si 4 tentatives dans la journée
					if ($nb_tentative == 3)
					{
						$this->redirect('index.php?erreur=16');
					}
					// Si le nombre de tentative de la journée = 4 alors bloqué
					else
					{
						$this->redirect('index.php?erreur=1'); //login + mdp pour sécurité
					}
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
				$verification_mail = Utilisateur::getByMail($mail);
				if ($verification_mail != False)
				{ //mail présent dans la table utilisateur
						$code_verification = UtilitaireControleur::chaineAleatoire(10); //Code de vérification généré aléatoirement
						$gestionMdp = MdpOublie::getByMail($mail); //Recupere un objet MdpOublie
						if($gestionMdp != null) 
						{ //mail présent dans la table mdp_oublie				
							$gestionMdp->setCode($code_verification);
							$update = $gestionMdp->save(); //modifie dans la table mdp_oublie
						}
						else
						{ //mail non présent dans la table mp_oublie
							$nouvelleDemande = new MdpOublie();
							$nouvelleDemande->setMail($mail);
							$nouvelleDemande->setCode($code_verification);
							$nouvelleDemande->setConfirme(0);
							$create = $nouvelleDemande->save(); //ajoute dans la table mdp_oublie
						}
						
						$sujet_mail = "ExaDART : modification du mot de passe"; //Sujet du mail
						$message_mail = "
						<html>
							<head>
							</head>
							<body>
								Bonjour, <br>
								Une demande pour réinitialiser le mot de passe de votre compte ExaDART à été effectuée.<br> 
								Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer ce mail.<br>
								Pour définir un nouveau mot de passe, voici votre code de vérification : <br>
								<center><b>".$code_verification."</b><center>
								<br>
								<br>
								Ceci est un e-mail automatique, merci de ne pas répondre à cette adresse.
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
			$requete_verification = MdpOublie::getByMailCode($mail, $code_entre);//Recupere un objet MdpOublie			
			if ($requete_verification!=null)
			{ //Code OK
				$requete_verification->setConfirme(1); //Confirme l'entrée du code
				$save = $requete_verification->save();
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
			$MdpOublie = MdpOublie::getByMail($mail); //Récupère un objet MdpOublie
			$verification_confirme = $MdpOublie->getConfirme();
			if(intval($verification_confirme)==1)
			{ //Code de vérification OK
				if(!empty($mdp) && !empty($mdp_confirme))
				{ //champs mdp et mdp confirme remplis
					if($mdp===$mdp_confirme)
					{ //les 2 mdp correspondent
						$sel='yolo42'; //A mettre en place plus tard (concaténation dans sha1)
						$mdp = sha1($mdp); //Pour le hachage du mot de passe
						$utilisateur = Utilisateur::getByMail($mail); //Recupere objet utilisateur
						$utilisateur->SetMdp($mdp);
						$save = $utilisateur->save(); //modifie le mdp
						$MdpOublie->delete(); //Supprime la demande de la table
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