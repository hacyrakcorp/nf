<form method='post' name='enregistrer_nf' action="<?php echo $this->getServerParam('PHP_SELF'); ?>?page=creerNFAction" >
    <h3>MISSION DU MOIS</h3>   
        <input type='month' id = 'date_NF' name='date_NF' 
               class='form-inline'> 
    <button type='submit' class='btn-primary' value='Valider'>Valider</button>
</form>