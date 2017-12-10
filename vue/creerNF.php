<form method='post' name='creer_nf' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creer_nf" >
    <h3>MISSION DU MOIS</h3>
    <label for='mois_nf'>Mois et année : </label>
    <input type='month' id = 'mois_nf' name='mois_nf' class='form-inline'>
    <button type='button' class='btn-primary' value='Valider'>Valider</button>
</form>