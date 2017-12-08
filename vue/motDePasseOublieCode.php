<div id="connexion">
	<form method = "post" action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=traitementMotDePasseOublieVerifierCode">
		<h2>Code de vérification pour modifier le mot de passe</h2>
		<p> Un code de vérification vous a été envoyé par mail </p>
		<br>
		<div id="text">
			<input class="form-control" type="text" autocomplete="off" name="code_verif" placeholder="Code de vérification">
			<br>
			<input class = "btn-primary" type="submit" name="code_verif_valider" value = "Valider">
		</div>	
	</form>
</div>
