<h5>Attention !</h5>
<p> Voulez-vous vraiment supprimer le statut suivant : 
    <?php echo $statut->getLibelle(); ?> ?
</p>

<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=suppressionStatutAction" 
      method="POST">
    <input type="hidden" id = 'id' name='id' 
           value='<?php echo $statut->getId(); ?>'>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>
    <button type="submit" class="btn btn-danger"
            value="Supprimer">
        Supprimer</button>
</form>
