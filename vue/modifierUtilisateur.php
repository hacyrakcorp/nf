<h5>Modification</h5>
<p> Vous allez modifier l'utilisateur suivant : 
    <?php echo $utilisateur->getNom() . " " . $utilisateur->getPrenom(); ?>.
</p>
<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=modifierUtilisateurAction" 
      method="POST">
    <input type='hidden' id = 'id' name='id' 
           value='<?php echo $utilisateur->getId(); ?>'>
    <label>Modification : </label></br>
    <input type='text' id = 'Nom' name='Nom' class='myInput' placeholder='Nom'
           value='<?php echo $utilisateur->getNom(); ?>'>&nbsp</br>
    <input type='text' id = 'Prenom' name='Prenom' class='myInput' placeholder='Prénom'
           value='<?php echo $utilisateur->getPrenom(); ?>'>&nbsp</br>
    <input type='text' id = 'Mail' name='Mail' class='myInput' placeholder='Mail'
           value='<?php echo $utilisateur->getLogin(); ?>'>&nbsp</br>
    <input type='password' id = 'Mdp' name='Mdp' class='myInput' placeholder='Mdp'
           value='<?php echo $utilisateur->getMdp(); ?>'>&nbsp</br>
    <select id='Statut' name='Statut'>
        <?php
        //Récupère les statuts existant
        foreach ($listeStatut as $unStatut) {
            $libelleStatut = $unStatut->getLibelle();
            if ($unStatut->getId() == $utilisateur->getStatut()->getId()) {
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
            if ($unService->getId() == $utilisateur->getService()->getId()) {
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
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" 
                data-dismiss="modal">
            Fermer</button>  
        <button type="submit" class="btn btn-primary"
                value="Modifier">
            Enregistrer</button>
</form>