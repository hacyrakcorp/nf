<h5>Récapitulatif de la note de frais</h5>
<?php
if ($tabLigneNF != null) { //La NF contient des lignes
    ?>
    <div class="responsive-table-line">
        <table class="table table-bordered table-condensed table-body-center 
               table-striped w-width" >
            <thead> 
                <tr>
                    <th>Date</th>
                    <th>Objet</th>
                    <th>Lieu</th>
                    <th>Montant</th>
                    <th></th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($tabLigneNF as $ligneNF) { /* @var $ligneNF LigneNF */
                    ?>
                    <tr> 
                        <td data-title="Date">
                            <?php
                            echo $ligneNF->getDate_ligne();
                            ?>
                        </td>
                        <td data-title="object">
                            <?php
                            echo $ligneNF->getObject();
                            ?>
                        </td>
                        <td data-title="lieu">
                            <?php
                            echo $ligneNF->getLieu();
                            ?>
                        </td>
                        <td data-title="montant">
                            <?php
                            echo $ligneNF->getMontant();
                            ?>
                        </td> 
                        <td>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Modifier la ligne" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'ModifierLigne' 
                                        class="btn btn-primary btn-xs" 
                                        >
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                        </td>
                        <?php
                    }
                    ?>
            </tbody>
        </table>  
    </div>
    <?php
} else { //La NF est vide
    ?>
    <p> La fiche de frais est vide.</p>
    <?php
}
?>

<h5>Ajouter des frais</h5>
<form method="Post"
      action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=ajoutNFAction">
    <input type="hidden" id="id_NF" name='id_NF' value="<?php echo $id; ?>" />
    <input type="hidden" id="id_ligne" name='id_ligne' value="" />
    <legend>Général</legend>
    <label class="labelLeft" for="date">Date :</label>  
    <input type="date" id="date" name="date"/><br />
    <label class="labelLeft" for="object">Objet :</label>
    <input type="text" id="object" name="object"/><br />
    <label class="labelLeft" for="lieu">Lieu :</label>  
    <input type="text" id="lieu" name="lieu"/>
    <legend>Nature du frais</legend>
    <table>
        <?php
        foreach ($tabNatureFrais as $nature) {
            ?>
            <tr>
                <td class="natureFrais">
                    <input type="checkbox" class="form-check-input"
                           name="nature[]" 
                           id="nature"
                           value = "<?php echo $nature->getId(); ?>" />
                           <?php echo $nature->getLibelle(); ?>  
                </td>
                <td>
                    <label class="labelRight" for="unite">
                        <?php echo $nature->getUnite(); ?> </label>
                    <?php if ($nature->getType_valeur() == "Double") {
                        ?>
                        <input type="number" step="0.01" min="0"
                               name="valeur"
                               id="valeur"/><br />
                               <?php
                           } elseif ($nature->getType_valeur() == "Integer") {
                               ?>
                        <input type="number" step="1" min="0"
                               name="valeur"
                               id="valeur"/><br />
                               <?php
                           }
                           ?>
                </td>
            </tr>
        <?php }
        ?>
    </table>
    <button type="submit" class="btn btn-success">
        Enregistrer
    </button>
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>