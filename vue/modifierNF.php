<h5>Modification</h5>
<p> Vous allez modifier la note de frais du 
    <?php echo $_POST['date']; ?>.
</p>
<input type='hidden' id = 'id_NF' name='id_NF' 
       value='<?php echo $_POST['id']; ?>'>

<label>Modification : </label>
<input type='month' id = 'date_NF' name='date_NF' class='form-inline'
       value='<?php echo $_POST['date']; ?>'
       >
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>  
    <button type="submit" class="btn btn-primary"
            name ="Modifier"
            value="<?php echo $_POST['id']; ?>">
        Enregistrer</button>