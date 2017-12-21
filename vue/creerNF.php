<form method='post' name='enregistrer_nf' action="<?php echo $this->getServerParam('PHP_SELF'); ?>?page=enregistrer_nf" >
    <h3>MISSION DU MOIS</h3>   
        <input type='hidden' id = 'Id_NF' name='Id_NF' value=''>
        <input type='month' id = 'mois_annee_NF' name='mois_annee_NF' 
               class='form-inline'> 
    <button type='submit' class='btn-primary' value='Valider'>Valider</button>
</form>