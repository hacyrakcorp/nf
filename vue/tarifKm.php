<h2>Ajouter un nouveau tarif</h2>
<div>
    <form method="post" name='creer_tarif' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creerTarifAction">
        <input type='month' id = 'mois_annee' name='mois_annee' class='myInput' placeholder='Mois_annee'>&nbsp</br>
        <input type='number' id = 'tarif' name='tarif' class='myInput' placeholder='Tarif du Km' step="0.01" min="0">&nbsp</br>
        <input type='submit' class="btn btn-primary btn-xl"  value='Enregistrer'>&nbsp
    </form>
</div>

<h2>Liste des tarifs</h2>
<div>
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Mois Annee</th>
                <th>Tarif</th>
                <th></th>
            </tr>
            <?php
            foreach ($listeTarif as $unTarif) {
                ?>
                <tr> 
                    <td data-title="Mois_annee">
                        <?php
                        echo $unTarif->getMois_annee();
                        ?>
                    </td>
                    <td data-title="Tarif">
                        <?php
                        echo $unTarif->getTarif_km();
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
                                                        'suppressionTarif',
                                                        '<?php echo $unTarif->getMois_annee(); ?>')">
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
                    Tarif
                </h5>
            </div>
            <div class="modal-body" id = "modal_body">              
                <!-- Charge le contenu de la page selon le bouton cliqué !-->
            </div>
        </div>
    </div>
</div>

<script>
    function getValeur(btn_click, mois_annee) {
        $(document).ready(function () {
            $('#modal_body').load('<?php echo $this->getServerParam('PHP_SELF') ?>?page=' + btn_click,
                    {'mois_annee': mois_annee});
        });
    }
</script>