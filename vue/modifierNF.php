<?php
    /* @var $noteDeFrais NoteDeFrais */
?>
<h5>Modification</h5>
<p> Vous allez modifier la note de frais du 
    <?php echo $noteDeFrais->getMois_annee(); ?>.
</p>
<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=modifierNFAction" 
      method="POST">
    <input type='hidden' id = 'id' name='id' 
           value='<?php echo $noteDeFrais->getId(); ?>'>

    <label>Modification : </label>
    <input type='month' id = 'date_NF' name='date_NF' class='form-inline'
           value='<?php echo $noteDeFrais->getMois_annee(); ?>'
           >
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" 
                data-dismiss="modal">
            Fermer</button>  
        <button type="submit" class="btn btn-primary"
                value="Modifier">
            Enregistrer</button>
</form>