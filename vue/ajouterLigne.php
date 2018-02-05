<p data-placement="rigth" data-toggle="tooltip" title="Retour">
    <button type="button" name = 'Retour' class="btn btn-primary btn-xl"
            onclick="javascript:location.href = '<?php echo $this->getServerParam('PHP_SELF') ?>?page=listerNF'">
        Retour à liste des notes de frais
    </button>
</p>


<h2>Récapitulatif de la note de frais (Total <?php echo $tabNF->getTotal(); ?>)</h2>
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
                            echo $ligneNF->getTotal();
                            ?>
                        </td> 
                        <td>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Modifier la ligne" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'Modifier' 
                                        class="btn btn-primary btn-xs" 
                                        data-title="Modifier" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur(
                                                    'modifierLigne',
                                                    '<?php echo $ligneNF->getId(); ?>',
                                                    '<?php echo $ligneNF->getDate_ligne(); ?>')"> 
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                           <p data-placement="right" data-toggle="tooltip" 
                               title="Supprimer" 
                               style="display:inline-block;">
                                <button type="button" 
                                        class="btn btn-danger btn-xs" 
                                        data-title="Supprimer" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur(
                                                    'suppressionLigne',
                                                    '<?php echo $ligneNF->getId(); ?>',
                                                    '<?php echo $ligneNF->getDate_ligne(); ?>')"> 
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

<h2>Ajouter des frais</h2>
<div id="ligneNF">
<form method="Post"
      action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=ajouterLigneAction">
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
    <hr>
    <div id="divLigne">
    <button type="submit" class="btn btn-success" id="buttonLigne">
        Enregistrer
    </button>
    </div>
</form>
</div>
</br>

<!--Fenetre Modal!-->
<div class="modal fade" id="fen_modal" tabindex="-1" 
     role="dialog" 
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fen_modal">
                    Ligne de frais du  
                    <span id="date_ligne_titre"></span>
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
    
    function getValeur(btn_click, id, date) {
        document.getElementById("date_ligne_titre").innerHTML = date;
        $(document).ready(function () {
            $('#modal_body').load('<?php echo $this->getServerParam('PHP_SELF') ?>?page='+btn_click,
                    {'id': id, 'date': date});
        });
}
</script>
