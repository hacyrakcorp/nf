<h5>Attention !</h5>
<p> Voulez-vous vraiment soumettre la note de frais du 
    <?php echo $_POST['date']; ?> ?
</p>
<p>
    Cela implique que la fiche de frais ne pourra plus être modifiée et/ou
    supprimée. Elle sera transmisse au service comptable.
</p>
</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>  
    <button type="submit" class="btn btn-success"
            name ="Soumettre"
            value="<?php echo $_POST['id']; ?>">
        Soumettre</button>
