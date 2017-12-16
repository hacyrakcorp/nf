<form method='post' name='enregistrer_nf' action="<?php echo $this->getServerParam('PHP_SELF'); ?>?page=enregistrer_nf" >
    <h3>MISSION DU MOIS</h3>
    <?php
    $id_NF = $this->getSessionParam('id_NF');
    if (empty($id_NF)) {
        ?>
        <input type='hidden' id = 'Id_NF' name='Id_NF' value=''>
        <input type='month' id = 'mois_annee_NF' name='mois_annee_NF' 
               class='form-inline'> 
               <?php
           } else {
               $listeNF = DeclarantControleur::recupereNF();
               $mois_annee = $listeNF['1'];
               ?>
        <input type='hidden' id = 'Id_NF' name='Id_NF' 
               value='<?php echo $id_NF; ?>'></td>
        <input type='month' id = 'mois_annee_NF' name='mois_annee_NF' 
               class='form-inline'
               value = '<?php echo $mois_annee; ?>'> 

        <?php
    }
    ?>

    <button type='submit' class='btn-primary' value='Valider'>Valider</button>
</form>