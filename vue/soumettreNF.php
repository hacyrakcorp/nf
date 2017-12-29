<h5>Attention !</h5>
<p> Voulez-vous vraiment soumettre la note de frais du 
    <?php echo $noteDeFrais->getMois_annee(); ?> ?
</p>
<p>
    Cela implique que la fiche de frais ne pourra plus être modifiée et/ou
    supprimée. Elle sera transmisse au service comptable.
</p>
<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=soumettreNFAction" 
      method="POST">
    <input type="hidden" id = 'id' name='id' 
           value='<?php echo $noteDeFrais->getId(); ?>'>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>  
    <button type="submit" class="btn btn-success"
            value="Soumettre">
        Soumettre</button>
</form>