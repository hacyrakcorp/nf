<h2>Ajouter un nouvel utilisateur</h2>
<div>
    <form method="post" name='creer_utilisateur' action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=creerUtilisateurAction">
        <input type='hidden' id = 'Id' name='Id' value=''>
        <input type='text' id = 'Nom' name='Nom' class='myInput' placeholder='Nom'>&nbsp</br>
        <input type='text' id = 'Prenom' name='Prenom' class='myInput' placeholder='Prénom'>&nbsp</br>
        <input type='text' id = 'Mail' name='Mail' class='myInput' placeholder='Mail'>&nbsp</br>
        <input type='password' id = 'Mdp' name='Mdp' class='myInput' placeholder='Mdp'>&nbsp</br>
        <select id='Statut' name='Statut'>
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
<h2>Modifier les utilisateurs</h2>
<div>
    <p>Filtrer : </p>
    <form method="post" name="filtrer" action ='<?php echo $this->getServerParam('PHP_SELF') ?>?page=filtrerAction'>
        <select id='FiltrerStatut' name='FiltrerStatut'>
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
        <select id='FiltrerService' name='FiltrerService'>
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
        </select>
        <p data-placement="right" data-toggle="tooltip" 
           title="Filtrer" 
           style="display:inline-block;">
            <button type="submit" 
                    name = 'Filtrer' 
                    class="btn btn-primary btn-xl" 
                    value="filtre">
                <span>Filtrer</span>
            </button>
        </p>
    </form>
    <p></p>
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
            if ($listeUtilisateur != null) {
                foreach ($listeUtilisateur as $utilisateur) {
                    ?>
                    <tr> 
                        <td data-title="Nom">
                            <?php
                            echo $utilisateur->getNom();
                            ?>
                        </td>
                        <td data-title="Prenom">
                            <?php
                            echo $utilisateur->getPrenom();
                            ?>
                        </td>
                        <td data-title="Mail">
                            <?php
                            echo $utilisateur->getLogin();
                            ?>
                        </td>
                        <td data-title="Statut">
                            <?php
                            echo $utilisateur->getStatut()->getLibelle();
                            ?>
                        </td>
                        <td data-title="Service">
                            <?php
                            echo $utilisateur->getService()->getLibelle();
                            ?>
                        </td>
                        <td>
                            <p data-placement="right" data-toggle="tooltip" 
                               title="Modifier l'utilisateur" 
                               style="display:inline-block;">
                                <button type="button" 
                                        name = 'Modifier' 
                                        class="btn btn-primary btn-xs" 
                                        value ='<?php echo $utilisateur->getId(); ?>'
                                        data-title="Modifier" 
                                        data-toggle="modal" 
                                        data-target="#fen_modal"
                                        onClick="getValeur('modifierUtilisateur',
                                                            '<?php echo $utilisateur->getId(); ?>')">
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
                                                            'suppressionUtilisateur',
                                                            '<?php echo $utilisateur->getId(); ?>')">
                                    <span class="glyphicon glyphicon-trash">  
                                    </span>
                                </button>
                            </p>
                        </td>
                        <?php
                    }
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
                    Utilisateurs
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