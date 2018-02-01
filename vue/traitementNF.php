<p data-placement="rigth" data-toggle="tooltip" title="Retour">
    <button type="button" name = 'Retour' class="btn btn-primary btn-xl"
            onclick="javascript:location.href = '<?php echo $this->getServerParam('PHP_SELF') ?>?page=tableauBord'">
        Retour à liste des notes de frais
    </button>
</p>

<!-- ------------------------------------------------------------------------ !-->
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

<!-- ------------------------------------------------------------------------ !-->
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
                    <select id='code_analytique' name='code_analytique'>
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
                    <input type="number" min=0 id="montant" name="montant" required/>
                </td>
                <td style="padding-left: 25px;">

                    <button type='submit'
                            class="btn btn-success"
                            >Enregistrer</button>
                </td>
            </tr> 
        </table> 
    </form>
    <!-- ------------------------------------------------------------------------ !-->
    <legend>Récapitulatif du traitement</legend>    
    <?php
    if ($tabLigneOM != null) { //La NF contient des lignes
        ?>
        <div class="responsive-table-line">
            <table class="table table-bordered table-condensed table-body-center 
                   table-striped w-width" >
                <thead> 
                    <tr>
                        <th>Numéro de rapport</th>
                        <th>Code analytique</th>
                        <th>Affaire</th>
                        <th>Montant</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    foreach ($tabLigneOM as $ligneOM) { /* @var $ligneNF LigneNF */
                        ?>
                        <tr> 
                            <td data-title="num_rapport">
                                <?php
                                echo $ligneOM->getNumero_rapport();
                                ?>
                            </td>
                            <td data-title="code_ana">
                                <?php
                                echo $ligneOM->getId_code_analytique()->getLibelle()
                                . " (" .
                                $ligneOM->getId_code_analytique()->getId()
                                . ")";
                                ?>
                            </td>
                            <td data-title="affaire">
                                <?php
                                echo $ligneOM->getAffaire();
                                ?>
                            </td>
                            <td data-title="montant">
                                <?php
                                echo $ligneOM->getMontant();
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
        <p> La fiche de frais n'est pas traitée.</p>
        <?php
    }
    ?>
    <!-- ------------------------------------------------------------------------ !-->
    <legend>Règlement</legend>
    <table>
        <tr>
            <td>
                <label>Mode de règlement :</label>
            </td>
            <td>
                <select id='reglement' name='reglement' onchange="afficher()">
                    <option value= 'Espece'>Espèce</option>
                    <option value= 'Cheque'>Chèque</option>
                </select>
            </td>
            <td><div id="numero"></div></td>
            <td><div id="banque"></div></td>
        </tr>
        <tr>
            <td>
                <label class="labelLeft" for="regleLe">Réglé le :</label>
            </td>
            <td>
                <input type="date" id="regleLe" name="regleLe" required/>
            </td>
            <td style="padding-left: 25px;">
                <button type='submit'
                        class="btn btn-success"
                        >Enregistrer</button>
            </td>
    </table>
    </br>
    </br>
</div>


<script>
    function afficher() {
        alert(document.getElementById('reglement').value);
        /*
        //Ceci va te renvoyer la value de l'option sur laquelle tu as cliqué ce qui peut être utile pour la suite..
        var value_option = liste.options[liste.selectedIndex].value;
        //liste correpond au name de ma balise select 
        //======
        
        //Creation d'un élément
        var option = document.createElement('input');
        //Instanciation du type d'élément : text...
        option.type = ("text");
        //Instanciation de la valeur de l'input text
        option.value = value_option;

        //On fixe ce champ input dans la div elements
        document.getElementById('numero').appendChild(option);
        */
    }
</script>