<h5>Attention !</h5>
<p> Voulez-vous vraiment supprimer le tarif suivant : 
    <?php echo $tarif->getMois_annee(); ?> ?
</p>

<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=suppressionTarifAction" 
      method="POST">
    <input type="hidden" id = 'mois_annee' name='mois_annee' 
           value='<?php echo $tarif->getMois_annee(); ?>'>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>
    <button type="submit" class="btn btn-danger"
            value="Supprimer">
        Supprimer</button>
</form>
