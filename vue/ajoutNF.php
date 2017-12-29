<h5>Récapitulatif de la note de frais</h5>
<?php
include '../controleur/BaseControleur.php';
include '../controleur/DeclarantControleur.php';
include '../modele/Connexion.php';
include '../modele/Statut.php';
include '../modele/Service.php';
include '../modele/Etat.php';
include '../modele/Utilisateur.php';
include '../modele/NoteDeFrais.php';
include '../modele/LigneNF.php';
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
                <th></th>
            </tr>
        </thead> 
        <tbody>
            <?php
            $id_NF = intval($_POST['id']);
            $objet = new DeclarantControleur();
            $listeNF = $objet->recupereLigneAll();
            //$listeNF = DeclarantControleur::recupereLigneAll();
            $lenTab = count($listeNF);
            $len = 0;
            while ($len < $lenTab) {
                $donnees = $listeNF[$len];
                $id = $donnees['0'];
                $date = $donnees['1'];
                $object = $donnees['2'];
                $lieu = $donnees['3'];
                $montant = $donnees['4'];
                $len++;
                ?>
                <tr> 
                    <td data-title="Date">
                        <?php echo $date;
                        ?>
                    </td>
                    <td data-title="object">
                        <?php echo $object;
                        ?>
                    </td>
                    <td data-title="lieu">
                        <?php echo $lieu;
                        ?>
                    </td>
                    <td data-title="montant">
                        <?php echo $montant;
                        ?>
                    </td>
                    <td>
                        <p data-placement="right" data-toggle="tooltip" 
                           title="Modifier la ligne" 
                           style="display:inline-block;">
                            <button type="button" 
                                    name = 'ModifierLigne' 
                                    class="btn btn-primary btn-xs" 
                                    >
                                <span class="glyphicon glyphicon-pencil">
                                </span>
                            </button>
                        </p>
                    </td>
                    <?php
                }
                ?>
        </tbody>
    </table>
</div>

<hr>
<h5>Ajouter un ligne</h5>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" 
            data-dismiss="modal">
        Fermer</button>
    <button type="button" class="btn btn-primary">
        Enregistrer</button>