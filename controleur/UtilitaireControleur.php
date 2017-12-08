<?php

class UtilitaireControleur extends BaseControleur
{
	public static function chaineAleatoire($taille_mdp) 
	{ //Génère une chaine de caractère unique et aléatoire
		$chaine = "";
		$liste_caractere = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$*%#";
		for($i=0; $i<$taille_mdp; $i++) 
		{
			$chaine .= $liste_caractere[rand()%strlen($liste_caractere)];
		}
		return $chaine;
	}
	
	public static function envoyerMail($mail_destinataire, $sujet, $message)
	{ //Création du header du mail
		$en_tete = "From: \"MOI\"<exadart@gmail.com>\r\n";
		$en_tete.= "Reply-to: \"MOI\" <exadart@gmail.com>"."\n";
		$en_tete.= "MIME-Version: 1.0"."\n";
		$en_tete.= "Content-Type: text/html; charset='utf-8'";		
		return mail($mail_destinataire,$sujet,$message,$en_tete); //Envoi de l'e-mail		
	}
	
	
}
?>