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
                            foreach ($totalLigne as $ligne) {
                                foreach ($ligne as $montant) {
                                    if ($ligneNF->getId() == $montant['id_ligne_frais']) {
                                        //Arrondi à 2 chiffres après la virgule
                                        echo number_format($montant['total'], 2, ".", " ");
                                    }
                                }
                            }
                            ?>
                        </td> 
                        <td>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Modifier la ligne" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'ModifierLigne' 
                                        class="btn btn-primary btn-xs"
                                        data-target="#modal"
                                        >
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Supprimer la ligne" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'SupprimerLigne' 
                                        class="btn btn-danger btn-xs" 
                                        data-target="#modal"
                                    >
                                    <span class="glyphicon glyphicon-trash">
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
    <input type="date" id="date" name="date" required/><br />
    <label class="labelLeft" for="object">Objet :</label>
    <input type="text" id="object" name="object" required/><br />
    <label class="labelLeft" for="lieu">Lieu :</label>  
    <input type="text" id="lieu" name="lieu" required/>
    <legend>Nature du frais</legend>
    <table>
        <?php foreach ($tabNatureFrais as $nature): ?>
            <tr>
                <td class="natureFrais">
                    <?php //chexbox = nature choisie  ?>
                    <input type="checkbox" class="form-check-input"
                           name="natureChoisie[]"
                           id="nature"
                           value="<?php echo $nature->getId(); ?>"
                           onchange="javascript:degrise(<?php echo $nature->getId(); ?>)"/>
                           <?php echo $nature->getLibelle(); ?>
                </td>
                <td>
                    <label class="labelRight" for="unite"><?php echo $nature->getUnite(); ?></label>
                    <?php if ($nature->getType_valeur()->getId() == TypeValeur::DOUBLE_ID): ?>
                        <?php $step = "0.01"; ?>
                    <?php elseif ($nature->getType_valeur()->getID() == TypeValeur::INTEGER_ID): ?>
                        <?php $step = "1"; ?>
                    <?php endif; ?>
                    <?php //Un seul input => valeur de la nature ?>
                    <?php //input => name+ id de la nature pour différencier?>
                    <input type="number" step="<?php echo $step ?>" min="0"
                           name="valeurNature<?php echo $nature->getId(); ?>"
                           id="valeurNature<?php echo $nature->getId(); ?>"
                           disabled="disabled" /><br/>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" class="btn btn-success">
        Enregistrer
    </button>
    <input type="hidden" name="fenetre_modal" value="">
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary"
            data-dismiss="modal">
        Fermer
    </button>


    <!--Fenetre Modal!-->
    <div class="modal fade" id="modal" tabindex="-1" 
         role="dialog" 
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fen_modal">
                        Fiche de frais du mois de 
                        <span id="date_NF_titre"></span>
                    </h5>
                </div>
                <div class="modal-body" id = "modal_body">              
                    <!-- Charge le contenu de la page selon le bouton cliqué !-->
                </div>
            </div>
        </div>
    </div>
    <script>
        function degrise(id_nature) {
            var valeurNature = document.getElementById('valeurNature' + id_nature);
            valeurNature.disabled = !valeurNature.disabled;
            valeurNature.required == true;
            valeurNature.value = '';
            valeurNature.focus() == true;
        }

    </script>
