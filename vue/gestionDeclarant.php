<h2>Ajouter un nouveau déclarant</h2>
<div>
    <form method="post" name='creer_declarant' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creerDeclarantAction">
        <input type='hidden' id = 'Id' name='Id' value=''>
        <input type='text' id = 'Nom' name='Nom' class='myInput' placeholder='Nom'>&nbsp</br>
        <input type='text' id = 'Prenom' name='Prenom' class='myInput' placeholder='Prénom'>&nbsp</br>
        <input type='text' id = 'Mail' name='Mail' class='myInput' placeholder='Mail'>&nbsp</br>
        <input type='password' id = 'Mdp' name='Mdp' class='myInput' placeholder='Mdp'>&nbsp</br>
        <select id='Statut' name='Statut'>
            <option></option>
            <?php
            //Récupère les statuts existant
            foreach ($listeStatut as $unStatut) {
                $libelleStatut = $unStatut->getLibelle();
            ?>
                <option value= '<?php echo $unStatut->getId(); ?>'><?php echo $libelleStatut; ?></option>
                <?php
            }
            ?>
        </select></br>
        <select id='Service' name='Service'>
            <option></option>
            <?php
            //Récupère les services existant
            foreach ($listeService as $unService) {
                $libelleService = $unService->getLibelle();
                ?>
                <option value= '<?php echo $unService->getId(); ?>'><?php echo $libelleService; ?></option>
                <?php
            }
            ?>
        </select></br>
        <input type='submit' class="btn btn-primary btn-xl"  value='Enregistrer'>&nbsp
    </form>
</div>
<h2>Modifier les déclarants</h2>
<div>
    <table class="table table-bordered table-condensed table-body-center 
           table-striped w-width" >
        <thead> 
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Mail</th>
                <th>Statut</th>
                <th>Service</th>
                <th></th>
            </tr>
<?php
foreach ($listeDeclarant as $declarant) {
    ?>
                <tr> 
                    <td data-title="Nom">
                <?php
                echo $declarant->getNom();
                ?>
                    </td>
                    <td data-title="Prenom">
                        <?php
                        echo $declarant->getPrenom();
                        ?>
                    </td>
                    <td data-title="Mail">
                        <?php
                        echo $declarant->getLogin();
                        ?>
                    </td>
                    <td data-title="Statut">
                        <?php
                        echo $declarant->getStatut()->getLibelle();
                        ?>
                    </td>
                    <td data-title="Service">
                        <?php
                        echo $declarant->getService()->getLibelle();
                        ?>
                    </td>
                    <td>
                        <p data-placement="right" data-toggle="tooltip" 
                           title="Modifier le déclarant" 
                           style="display:inline-block;">
                            <button type="button" 
                                    name = 'Modifier' 
                                    class="btn btn-primary btn-xs" 
                                    value ='<?php echo $declarant->getId(); ?>'
                                    data-title="Modifier" 
                                    data-toggle="modal" 
                                    data-target="#fen_modal"
                                    onClick="getValeur('modifierDeclarant',
                                                            '<?php echo $declarant->getId(); ?>')">
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
                                                            'suppressionDeclarant',
                                                            '<?php echo $declarant->getId(); ?>')">
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
                    Déclarants
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