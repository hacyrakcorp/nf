<h5>Attention !</h5>
<p> Voulez-vous vraiment supprimer le service suivant : 
    <?php echo $service->getLibelle(); ?> ?
</p>

<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=suppressionServiceAction" 
      method="POST">
    <input type="hidden" id = 'id' name='id' 
           value='<?php echo $service->getId(); ?>'>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>
    <button type="submit" class="btn btn-danger"
            value="Supprimer">
        Supprimer</button>
</form>
