<h5>Attention !</h5>
<p> Vous allez modifier la ligne de frais du 
    <?php echo $ligne->getDate_ligne(); ?>.
</p>
<form method="post" name='form_modif_ligne' 
      action='<?php echo $this->getServerParam('PHP_SELF') ?>?page=modifierLigneAction'>
<input type="hidden" id="id_NF" name='id_NF' value="<?php echo $ligne->getId_note_frais()->getId(); ?>" />
<input type="hidden" id="id_ligne" name='id_ligne' value="<?php echo $ligne->getId(); ?>" />
<legend>Général</legend>
<label class="labelLeft" for="date">Date :</label>  
<input type="date" id="date" name="date" value="<?php echo $ligne->getDate_ligne(); ?>" required/><br />
<label class="labelLeft" for="object">Objet :</label>
<input type="text" id="object" name="object" value = "<?php echo $ligne->getObject(); ?>" required/><br />
<label class="labelLeft" for="lieu">Lieu :</label>  
<input type="text" id="lieu" name="lieu" value="<?php echo $ligne->getLieu(); ?>" required/>
<legend>Nature du frais</legend>
<table>
    <!-- mise en place du formulaire Valeurs Frais!-->
    <?php foreach ($tabNatureFrais as $nature): ?>
        <tr>
            <td class="natureFrais">
                <!-- chexbox = nature choisie  !-->
                <input type="checkbox" class="form-check-input"
                       name="natureChoisieM[]"
                       id="nature"
                       value="<?php echo $nature->getId(); ?>"
                       onchange="javascript:degrise(<?php echo $nature->getId(); ?>)"
                       <?php
                       //parcours valeurs de la ligne
                       foreach ($tabValeur as $valeur) :
                           //si nature existe dans la ligne on coche
                           if ($valeur->getId_nature_frais()->getId() == $nature->getId()) :
                               ?>
                               checked
                               <?php
                           endif;
                       endforeach;
                       ?> /> 
                       <?php echo $nature->getLibelle(); ?>
            </td>
            <td>
                <label class="labelRight" for="unite"><?php echo $nature->getUnite(); ?></label>
                <?php if ($nature->getType_valeur()->getId() == TypeValeur::DOUBLE_ID): ?>
                    <?php $step = "0.01"; ?>
                <?php elseif ($nature->getType_valeur()->getID() == TypeValeur::INTEGER_ID): ?>
                    <?php $step = "1"; ?>
                <?php endif; ?>
                <?php //Un seul input => valeur de la nature  ?>
                <?php //input => name+ id de la nature pour différencier  ?>
                <input type="number" step="<?php echo $step ?>" min="0"
                       name="valeurNatureM<?php echo $nature->getId(); ?>"
                       id="valeurNatureM<?php echo $nature->getId(); ?>"
                       <?php
                       //parcours valeurs de la ligne
                       foreach ($tabValeur as $valeur) :
                           //si nature existe dans la ligne on recupere la valeur
                           if ($valeur->getId_nature_frais()->getId() == $nature->getId()) :
                               ?>
                               value="<?php echo $valeur->getValeur(); ?>"
                               <?php
                           endif;
                       endforeach;
                       ?>
                       />
                <!-- Grise les input selon la valeur de l'input!-->
                <script>
                    var mon_input = document.getElementById('valeurNatureM<?php echo $nature->getId(); ?>').value;
                    var valeurNatureM = document.getElementById('valeurNatureM<?php echo $nature->getId(); ?>');
                    if (mon_input) { //input contient valeur
                        valeurNatureM.disabled = false;
                    } else { //input est vide
                        valeurNatureM.disabled = true;
                    }
                </script>
                <br/>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</div>    
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>
    <button type="submit" class="btn btn-success" >
        Enregistrer
    </button>
</form>

<script>
    function degrise(id_nature) {
        var valeurNature = document.getElementById('valeurNatureM' + id_nature);
        valeurNature.disabled = !valeurNature.disabled;
        valeurNature.required == true;
        valeurNature.value = '';
        valeurNature.focus() == true;
    }
</script>