<h2>Ajouter une nouvelle nature de frais</h2>
<div>
    <form method="post" name='creer_natureFrais' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creerNatureFraisAction">
        <input type='text' id = 'Libelle' name='Libelle' class='myInput' placeholder='Libelle'>&nbsp</br>
        <select id='TypeValeur' name='TypeValeur'>
            <?php
            //Récupère les statuts existant
            foreach ($listeType as $unType) {
                $libelleType = $unType->getLibelle();
            ?>
                <option value= '<?php echo $unType->getId(); ?>'><?php echo $libelleType; ?></option>
                <?php
            }
            ?>
        </select></br>
        <input type='text' id = 'Unite' name='Unite' class='myInput' placeholder='Unite'>&nbsp</br>
        <input type='submit' class="btn btn-primary btn-xl"  value='Enregistrer'>&nbsp
    </form>
</div>
<h2>Liste des natures de valeurs disponibles</h2>
<div>
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Libelle</th>
                <th>Type de valeur</th>
                <th>Unite</th>
                <th></th>
            </tr>
            <?php
            foreach ($listeNature as $uneNature) {
                ?>
                <tr> 
                    <td data-title="Libelle">
                        <?php
                        echo $uneNature->getLibelle();
                        ?>
                    </td>
                    <td data-title="TypeValeur">
                        <?php
                        echo $uneNature->getType_valeur()->getLibelle();
                        ?>
                    </td> 
                    <td data-title="Unite">
                        <?php
                        echo $uneNature->getUnite();
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
                                                        'suppressionNatureFrais',
                                                        '<?php echo $uneNature->getId(); ?>')">
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
                    Natures des frais
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