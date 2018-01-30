<p data-placement="rigth" data-toggle="tooltip" title="Retour">
    <button type="button" name = 'Retour' class="btn btn-primary btn-xl"
            onclick="javascript:location.href = '<?php echo $this->getServerParam('PHP_SELF') ?>?page=tableauBord'">
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


<h2>Traitement de la fiche de frais</h2>
<div id="traitementNF">
    <form method="Post"
          action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=traitementNFAction">
        <input type="hidden" id="id_NF" name='id_NF' value="<?php echo $id; ?>" />
        <legend>Général</legend>
        <table>
            <tr>
                <td>
                    <label class="labelLeft" for="rapport">N° de rapport :</label>
                </td>
                <td>
                    <input type="text" id="rapport" name="rapport" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label> Code Analytique :</label> 
                </td>
                <td>
                    <select id='Code_analytique' name='Code_analytique'>
                        <?php
                        //Récupère les statuts existant
                        foreach ($tabCodeAnalytique as $unCode) {
                            $libelle = $unCode->getLibelle();
                            ?>
                            <option value= '<?php echo $unCode->getId(); ?>'>
                                <?php echo $libelle; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labelLeft" for="affaire">Affaire :</label> 
                </td>
                <td>
                    <input type="text" id="affaire" name="affaire" required/>
                </td>
                
            </tr>
            <tr>
                <td>
                    <label class="labelLeft" for="montant">Montant :</label>  
                </td>
                <td>
                    <input type="text" id="montant" name="montant" required/>
                </td>
                <td>
                    <button>Enregistrer</button>
                </td>
            </tr> 
        </table>
        <legend>Récapitulatif du traitement</legend>
    </form>