<h2>Ajouter un nouveau service</h2>
<div>
    <form method="post" name='creer_service' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creerServiceAction">
        <input type='text' id = 'Libelle' name='Libelle' class='myInput' placeholder='Libelle'>&nbsp</br>
        <input type='submit' class="btn btn-primary btn-xl"  value='Enregistrer'>&nbsp
    </form>
</div>
<h2>Liste des services disponibles</h2>
<div>
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Libelle</th>
                <th></th>
            </tr>
            <?php
            foreach ($listeService as $unService) {
                ?>
                <tr> 
                    <td data-title="Libelle">
                        <?php
                        echo $unService->getLibelle();
                        ?>
                    </td>    
                    <td>
                        <p data-placement="right" data-toggle="tooltip" 
                           title="Supprimer" 
                           style="display:inline-block;">
                            <button type="button" 
                                    class="btn btn-danger btn-xs" 
                                    data-title="Supprimer" 
                                    data-toggle="modal" 
                                    data-target="#fen_modal"
                                    onClick="getValeur(
                                                        'suppressionService',
                                                        '<?php echo $unService->getId(); ?>')">
                                <span class="glyphicon glyphicon-trash">  
                                </span>
                            </button>
                        </p>
                    </td>
                    <?php
                }
                ?>
        </thead> 
        <tbody>
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
                    Services
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
    function getValeur(btn_click, id) {
        $(document).ready(function () {
            $('#modal_body').load('<?php echo $this->getServerParam('PHP_SELF') ?>?page=' + btn_click,
                    {'id': id});
        });
    }
</script>