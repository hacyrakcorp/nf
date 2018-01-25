<h5>Modification</h5>
<p> Vous allez modifier le déclarant suivant : 
    <?php echo $declarant->getNom() . " " . $declarant->getPrenom(); ?>.
</p>
<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=modifierDeclarantAction" 
      method="POST">
    <input type='hidden' id = 'id' name='id' 
           value='<?php echo $declarant->getId(); ?>'>
    <label>Modification : </label></br>
    <input type='text' id = 'Nom' name='Nom' class='myInput' placeholder='Nom'
           value='<?php echo $declarant->getNom(); ?>'>&nbsp</br>
    <input type='text' id = 'Prenom' name='Prenom' class='myInput' placeholder='Prénom'
           value='<?php echo $declarant->getPrenom(); ?>'>&nbsp</br>
    <input type='text' id = 'Mail' name='Mail' class='myInput' placeholder='Mail'
           value='<?php echo $declarant->getLogin(); ?>'>&nbsp</br>
    <input type='password' id = 'Mdp' name='Mdp' class='myInput' placeholder='Mdp'
           value='<?php echo $declarant->getMdp(); ?>'>&nbsp</br>
    <select id='Statut' name='Statut'>
        <?php
        //Récupère les statuts existant
        foreach ($listeStatut as $unStatut) {
            $libelleStatut = $unStatut->getLibelle();
            if ($unStatut->getId() == $declarant->getStatut()->getId()) {
                ?>
                <option value= '<?php echo $unStatut->getId(); ?>' selected><?php echo $libelleStatut; ?></option>
            <?php } else {
                ?>
                <option value= '<?php echo $unStatut->getId(); ?>'><?php echo $libelleStatut; ?></option>
                <?php
            }
        }
        ?>
    </select></br>
    <select id='Service' name='Service'>
        <?php
        //Récupère les services existant
        foreach ($listeService as $unService) {
            $libelleService = $unService->getLibelle();
            if ($unService->getId() == $declarant->getService()->getId()) {
                ?>
                <option value= '<?php echo $unService->getId(); ?>' selected><?php echo $libelleService; ?></option>
            <?php } else {
                ?>
                <option value= '<?php echo $unService->getId(); ?>'><?php echo $libelleService; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" 
                data-dismiss="modal">
            Fermer</button>  
        <button type="submit" class="btn btn-primary"
                value="Modifier">
            Enregistrer</button>
</form>