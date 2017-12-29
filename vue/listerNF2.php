<div class="responsive-table-line">
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Note de frais</th>
                <th>Etat</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
            <?php            
            foreach($tabNF as $nf)
            { /* @var $nf NoteDeFrais */
                ?>
                <tr> 
                    <td data-title="Note de frais">
                        <?php
                        echo $nf->getMois_annee();
                        if ($nf->getId_etat()->getId() != Etat::SOUMIS_ID) {
                            ?>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Modifier la date" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'Modifier' 
                                        class="btn btn-primary btn-xs" 
                                        value ='<?php echo $nf->getId(); ?>'
                                        data-title="Modifier" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur('modifierNF',
                                                        '<?php echo $nf->getId(); ?>',
                                                        '<?php echo $nf->getMois_annee(); ?>')">
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                        <?php } ?>
                    </td>

                    <td data-title="Etat"> 
                        <?php echo $nf->getId_etat()->getLibelle(); ?></td>
                    <td> 
                       <?php if ($nf->getId_etat()->getId() != Etat::SOUMIS_ID) { ?>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Soumettre" 
                               style="display:inline-block;">
                                <button type="button" 
                                        class="btn btn-success btn-xs"
                                        data-title="Soumettre" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur('soumettreNF',
                                                        '<?php echo $nf->getId(); ?>',
                                                        '<?php echo $nf->getMois_annee(); ?>')">
                                    <span class="glyphicon glyphicon-ok">
                                    </span>
                                </button>
                            </p>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Ajouter des lignes" 
                               style="display:inline-block;">
                                <button type="button" name='Ajouter' 
                                        class="btn btn-warning btn-xs" 
                                        data-title="Ajouter" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur('ajoutNF',
                                                        '<?php echo $nf->getId(); ?>',
                                                        '<?php echo $nf->getMois_annee(); ?>')">
                                    <span class="glyphicon glyphicon-plus">  
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
                                                        'suppressionNF',
                                                        '<?php echo $nf->getId(); ?>',
                                                        '<?php echo $nf->getMois_annee(); ?>')">
                                        
                                    <span class="glyphicon glyphicon-trash">  
                                    </span>
                                </button>
                            </p>
                        <?php } else {
                            ?>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Consulter" 
                               style="display:inline-block;">
                                <button type="button" 
                                        class="btn btn-warning btn-xs" 
                                        data-title="Consulter" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur(
                                                        'voirNF',
                                                        '<?php echo $nf->getId(); ?>',
                                                        '<?php echo $nf->getMois_annee(); ?>')">
                                        
                                    <span class="glyphicon glyphicon-eye-open">  
                                    </span>
                                </button>
                            </p>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php }
            ?>	
        </tbody>
    </table>
</div>

<!--Fenetre Modal!-->
<div class="modal fade" id="fen_modal" tabindex="-1" 
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
    function getValeur(btn_click, id, date) {
        document.getElementById("date_NF_titre").innerHTML = date;
        $(document).ready(function () {
            $('#modal_body').load('<?php echo $this->getServerParam('PHP_SELF') ?>?page='+btn_click,
                    {'id': id, 'date': date});
        });

        /*
         * $('#modal_body').load('../vue/' + btn_click + '.php',
         {'id': id, 'date': date});
         * 
         * $.ajax({
         type: "POST",
         url: 'listerNF.php',
         data: 'maVariable='+ valeur,
         dateType:'html', 
         success : function(data){
         alert(data);
         document.getElementById("test").value = data;
         },
         });*/
    }
</script>