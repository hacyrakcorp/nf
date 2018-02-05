<p data-placement="rigth" data-toggle="tooltip" title="Retour">
    <button type="button" name = 'Retour' class="btn btn-primary btn-xl"
            onclick="javascript:location.href = '<?php echo $this->getServerParam('PHP_SELF') ?>?page=tableauBord'">
        Retour à liste des notes de frais
    </button>
</p>

<!-- ------------------------------------------------------------------------ !-->
<h2>Récapitulatif de la note de frais</h2>
<legend>Note de frais</legend>
<div class="responsive-table-line">
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Note de frais</th>
                <th>Déclarant</th>
                <th>Etat</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
            <tr> 
        <input type="hidden" 
               value="<?php echo $tabNF->getId(); ?>" 
               name ="id" id="id">
        <td data-title="Note de frais">
            <?php echo $tabNF->getMois_annee(); ?>
        </td>
        <td data-title="Declarant">
            <?php
            echo $tabNF->getId_utilisateur()->getNom()
            . " " .
            $tabNF->getId_utilisateur()->getPrenom();
            ?>
        </td>
        <td data-title="Etat"> 
            <?php echo $tabNF->getId_etat()->getLibelle(); ?>
        </td>
        <td>
            <?php echo $tabNF->getTotal(); ?>
        </td>
        <td> 
            <p data-placement="right" 
               data-toggle="tooltip" 
               title="Modifier l'état" 
               style="display:inline-block;">
                <button type="button" 
                        name = 'ModifierEtat' 
                        class="btn btn-primary btn-xs"
                        data-title="ModifierEtat" 
                        data-toggle="modal" 
                        data-target="#modal"
                        onClick="getValeur('modifierEtat',
                                    '<?php echo $tabNF->getId();?>',
                                    '<?php echo $tabNF->getMois_annee(); ?>')"
                        >
                    <span class="glyphicon glyphicon-pencil">
                    </span>
                </button>
            </p>
        </td>
        </tr>
        </tbody>   
    </table>  
</div>

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
<legend>Lignes de la note de frais</legend>
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
                    <input type="number" 
                           min=0 
                           step="0.01" 
                           id="montant" 
                           name="montant" required/>
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
    <legend>Récapitulatif du traitement 
        (Total => <?php echo $totalOM['total']; ?>)</legend>    
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
    <?php if ($tabReglement == null) : ?>
        <form method="Post"
              action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=reglementAction">
            <input type="hidden" id="id_NF" name='id_NF' value="<?php echo $id; ?>" />
            <p>
                <?php echo $totalOM['total']; ?>
            </p>
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
        </form>

    <?php else : ?>
        <div class="responsive-table-line">
            <table class="table table-bordered table-condensed table-body-center 
                   table-striped w-width" >
                <thead> 
                    <tr>
                        <th> Reglement</th>
                        <th> Date </th>
                        <th> Mode </th>
                        <?php if ($tabNF->getMode_reglement() == "Cheque"): ?>
                            <th> Numero du cheque</th>
                            <th> Banque</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> <?php echo $totalOM['total']; ?></td>
                        <td> <?php echo $tabReglement->getDate_reglement(); ?></td>
                        <td> <?php echo $tabNF->getMode_reglement(); ?></td>
                        <?php if ($tabNF->getMode_reglement() == "Cheque"): ?>
                            <td> <?php echo $tabNF->getNumero_cheque(); ?></td>
                            <td> <?php echo $tabNF->getBanque(); ?></td> 
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    </br>
    </br>
</div>


<script>
    function getValeur(btn_click, id, date) {
        document.getElementById("date_NF_titre").innerHTML = date;
        $(document).ready(function () {
            $('#modal_body').load('<?php echo $this->getServerParam('PHP_SELF') ?>?page=' + btn_click,
                    {'id': id, 'date': date});
        });
    }
    
    function afficher() {
        // Recup valeur de la combo reglement
        var select_reglement = document.getElementById('reglement').value;
        if (select_reglement == 'Cheque') {
            var div_numero = document.createElement('div');
            div_numero.id = "div_num";
            var label_num = document.createElement('label');
            label_num.for = "numero_cheque";
            label_num.class = "labelLeft";
            label_num.innerHTML = "Numéro : "
            var numero = document.createElement('input');
            numero.id = "numero_cheque";
            numero.name = "numero_cheque";
            numero.type = "text";
            numero.required = "required";
            // Fixe champs créer dans la div numero
            document.getElementById('numero').append(div_numero);
            document.getElementById('div_num').append(label_num);
            document.getElementById('div_num').append(numero);

            var div_banque = document.createElement('div');
            div_banque.id = "div_banque";
            var label_banque = document.createElement('label');
            label_banque.for = "label_banque";
            label_banque.class = "labelLeft";
            label_banque.innerHTML = "Banque : "
            var banque = document.createElement('input');
            banque.id = "input_banque";
            banque.name = "input_banque";
            banque.type = "text";
            banque.required = "required";
            // Fixe champs créer dans la div banque
            document.getElementById('banque').append(div_banque);
            document.getElementById('div_banque').append(label_banque);
            document.getElementById('div_banque').append(banque);

        } else {
            // Supprime div lors du changement de valeur de la div
            document.getElementById('div_num').remove();
            document.getElementById('div_banque').remove();
        }
    }
</script>