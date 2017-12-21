<h5>Attention !</h5>
<p> Voulez-vous vraiment supprimer la note de frais du 
    <?php echo $_POST['date']; ?> ?
</p>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>  
    <button type="submit" class="btn btn-danger"
            name ="Supprimer"
            value="<?php echo $_POST['id']; ?>">
        Supprimer</button>
