<div id="connexion">
<form method = "post" action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=traitementMotDePasseOublieEnvoyerCode" >
	<h2>Récupération du mot de passe</h2>
	<p> Donner votre adresse mail de connection pour recevoir un code de vérification </p>
	<div id="text">
		<input class="myInput" type="email" name="recuperation_mail" placeholder="Entrez votre adresse mail">
		<br>
		<br>
		<input class = "myButton" type="submit" name="recuperation_valider" value = "Valider" >
	</div>	
</form>
</div>