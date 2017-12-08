<?php

class JuryControleur extends BaseControleur
{
		
		
	public function accueilJury($id)
	{ //Page acceuil Admin		
		include $this->pathVue.'header.php';
        include $this->pathVue.'accueilJury.php';
        include $this->pathVue.'footer.php';
		
	}	
		
	public function remplirComboSession($id)
	{

	
	$bdd = Connexion::getInstance();
	$sql_listeSession = "SELECT id_session, nom_discipline, annee_session, nom_epreuve 
						FROM `session`
						JOIN binome ON id_session = CE_session
						JOIN discipline ON CE_discipline = id_discipline
						JOIN epreuve ON CE_epreuve = id_epreuve
						WHERE CE_jury = '$id'";
		$reponse = $bdd->requeter($sql_listeSession);
		$lenTab = count($reponse);
		$len=0;
		
		while ($len<$lenTab)
		{	
		$donnees = $reponse[$len];
		$id_session = $donnees['id_session'];
		$nom_discipline = $donnees['nom_discipline'];
		$annee_session = $donnees['annee_session'];
		$epreuve_session = $donnees['nom_epreuve'];
		$valeur = $id_session;
		$valeuraffiche = "Session ".$nom_discipline." ".$annee_session." (".$epreuve_session.")";
		$len++;
		echo "<option value= '$valeur'>$valeuraffiche</option>";
		}
	return;	
	}
	
	public function chargerSession()
	{
		$idsession = $this->getPostParam('IDsession');
		$this->redirect('index.php?idx='.$idsession.'');

	}
	
	public function chargerBinome($id)
	{
		
	$bdd = Connexion::getInstance();
	$sql_listeBinome = "SELECT nom_utilisateur, prenom_utilisateur
						FROM `utilisateur`
						JOIN Binome ON id_utilisateur = CE_jury
						WHERE CE_session = '$id'
						";
		$reponse = $bdd->requeter($sql_listeBinome);
		$lenTab = count($reponse);
		$len=0;
		$binome = "";
		while ($len<$lenTab)
		{	
		$donnees = $reponse[$len];
		$binome .= ", ".$donnees['nom_utilisateur']." ".$donnees['prenom_utilisateur'];
		$len++;
		}
		$binome = substr($binome,2);
		return $binome;	
	}
	
	
	public function chargerInformationSession($id)
	{
		
	$bdd = Connexion::getInstance();
	$sql_listeInfo = "SELECT annee_session, nom_discipline, nom_epreuve
						FROM `session`
						JOIN discipline ON CE_discipline = id_discipline
						JOIN epreuve ON CE_epreuve = id_epreuve
						WHERE id_session = '$id'
						";
		$reponse = $bdd->requeter($sql_listeInfo);
		$lenTab = count($reponse);
		$len=0;
		$info = "";
		while ($len<$lenTab)
		{	
		$donnees = $reponse[$len];
		$info .= "<h2>Session : ".$donnees['nom_discipline']." ".$donnees['annee_session']." ".$donnees['nom_epreuve']."</h2>";
		$len++;
		}

		return $info;	
	}
	
	public function chargerCandidatSession($id)
	{
		
	$bdd = Connexion::getInstance();
	$sql_listeCandidat = "SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur
						FROM `groupe_candidat`
						JOIN utilisateur ON CE_candidat = id_utilisateur
						WHERE `CE_session` = '$id'
						";
		$reponse = $bdd->requeter($sql_listeCandidat);
		$lenTab = count($reponse);
		$len=0;
		while ($len<$lenTab)
		{	
		$donnees = $reponse[$len];
		$idcandidat = $donnees['id_utilisateur'];
		echo "<tr><td>".$donnees['nom_utilisateur']." ".$donnees['prenom_utilisateur']."</td><td><input type='radio' name='checkIDcan' value='' onclick='charge_candidat($idcandidat);'></td></tr>";
		$len++;
		}

		return;	
	}
	
	
	
	
	public function supprimerJury()
	{
		
	}
	
	public function afficherJury()
	{

	}
	
	public function selectionnerJury()
	{
		
	}
	
}

?>