<div id="connexion">
	<form method="post" action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=traitementLogin">
		<h2>Connexion</h2>
		<div >
			<input  class="form-control" type="email" name="login" placeholder="Identifiant">
			<br>
			<input  class="form-control" type="password" name="motdepasse" placeholder="Mot de passe">
		</div>
		<br>
		<input class="btn-primary" type="submit" value="Se connecter">	
		<br>
		<br>
	</form>
	<form method="post" action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=motDePasseOublie">
		<input class="btn-primary" type="submit" value="Mot de passe oublié">
	</form>
</div>


	