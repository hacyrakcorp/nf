<?php
/* @var $noteDeFrais NoteDeFrais */
?>
<h5>Modification</h5>
<p> Vous allez modifier la note de frais du 
    <?php echo $noteDeFrais->getMois_annee(); ?>
    appartenant à <?php
    echo $noteDeFrais->getId_utilisateur()->getNom()
    . " " . $noteDeFrais->getId_utilisateur()->getPrenom();
    ?>.
</p>
<form action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=modifierEtatAction" 
      method="POST">
    <input type='hidden' id = 'idNF' name='idNF' 
           value='<?php echo $noteDeFrais->getId(); ?>'>

    <label>Etat : </label>
    <select id="etat" name="etat">
        <?php foreach ($listeEtat as $unEtat) : ?>
            <?php if ($unEtat->getId() != Etat::BROUILLON_ID):?>
             <?php if ($unEtat->getId() == $noteDeFrais->getId_etat()):?>
        <option value="<?php echo $unEtat->getId(); ?>" selected>
            <?php echo $unEtat->getLibelle(); ?>
        </option>
             <?php else : ?>
        <option value="<?php echo $unEtat->getId(); ?>">
            <?php echo $unEtat->getLibelle(); ?>
        </option>
             <?php endif; ?>
        
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>  
    <button type="submit" class="btn btn-primary"
            value="Modifier">
        Enregistrer</button>
</form>