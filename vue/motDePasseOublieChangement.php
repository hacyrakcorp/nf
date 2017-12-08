<div id="connexion">
<form method = "post" action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=traitementMotDePasseOublieModifierMdp">
	<h2>Modification du mot de passe</h2>
	<p> Saisir votre nouveau mot de passe </p>
	<div id="text">
		<input class="myInput" type="password" name="modification_mdp" placeholder="Nouveau mot de passe">
		<br>
		<input class="myInput" type="password" name="modification_mdp_confirme" placeholder="Confirmer le mot de passe">
		<br>
		<br>
		<input class="myButton" type="submit" name="modification_mdp_valider" value = "Valider" >
	</div>	
</form>
</div>