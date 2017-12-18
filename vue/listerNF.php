<form method="post">
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
                $listeNF = DeclarantControleur::recupereNFAll();
                $lenTab = count($listeNF);
                $len = 0;
                while ($len < $lenTab) {
                    $donnees = $listeNF[$len];
                    $id = $donnees['0'];
                    $mois_annee = $donnees['1'];
                    $etat = $donnees['2'];
                    $len++;
                    ?>
                    <tr> 
                        <td data-title="Note de frais">
                            <?php echo $mois_annee; ?>
                        </td>

                        <td data-title="Etat"> 
                            <?php echo $etat; ?></td></td>
                        <td> 
                            <?php if ($etat != "soumise") {
                                ?>
                                <p data-placement="rigth" data-toggle="tooltip" 
                                   title="Soumettre" 
                                   style="display:inline-block;">
                                    <input type="button" 
                                           name = 'Soumettre' 
                                            class="btn btn-success btn-xs"
                                            value = '<?php echo $id; ?>'
                                            data-title="Soumettre" 
                                            data-toggle="modal" 
                                            data-target="#soumettre"> 
                                        <span class="glyphicon glyphicon-ok">
                                        </span>
                                    </input>
                                </p>
                                <?php
                            }
                            ?>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Modifier la date" 
                               style="display:inline-block;">
                                <input type="button" 
                                       name = 'Modifier' 
                                        class="btn btn-primary btn-xs" 
                                        value ='<?php echo $id; ?>'
                                        data-title="Modifier" 
                                        data-toggle="modal" 
                                        data-target="#modifier">
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </input>
                            </p>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Ajouter des lignes" 
                               style="display:inline-block;">
                                <input type="hidden" 
                                       id='btn-ajouter' 
                                       name='btn-ajouter' 
                                       value='TEST'>
                                <button type="submit" name='Ajouter' 
                                        class="btn btn-warning btn-xs" 
                                        value='<?php echo $id; ?>'
                                        data-title="Ajouter" 
                                        data-toggle="modal" 
                                        data-target="#ajouter"></span>
                            
                                    <span class="glyphicon glyphicon-plus">  
                                    </span>
                                </button>
                            </p>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Supprimer" 
                               style="display:inline-block;">
                                <input type="button" 
                                       name='Supprimer' 
                                        class="btn btn-danger btn-xs" 
                                        value='<?php echo $id; ?>'
                                        data-title="Supprimer" 
                                        data-toggle="modal" 
                                        data-target="#supprimer"
                                        >
                                    <span class="glyphicon glyphicon-trash">  
                                    </span>
                                </button>
                            </p>
                        </td>
                    </tr>
                <?php }
                ?>	
            </tbody>
        </table>
    </div>
    <form>
<!--Fen modal !--> 
<form method="post" name='lister_nf' 
      form_action="<?php //echo $this->getServerParam('PHP_SELF') ?>?page=lister_nf" >
   
<div class="modal fade" id="ajouter" tabindex="-1" 
         role="dialog" 
         aria-labelledby="AjouterLignes" 
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouter">
                        Fiche de frais du mois de 
                            <?php echo $id; ?>
                    </h5>
                </div>
                <div class="modal-body">
                    <h5>Fiche de frais</h5>
                    <p><?php var_dump($_POST['Test']);?></p>
                    <p><?php var_dump($_POST['btn-ajouter']);?></p>
                    <p>This <a href="#" role="button" 
                               class="btn btn-secondary popover-test" 
                               title="Popover title" 
                               data-content="Popover body content is set in this attribute.">
                            button</a> 
                        triggers a popover on click.</p>
                    <hr>
                    <h5>Ajouter une ligne</h5>
                    <p><a href="#" class="tooltip-test" 
                          title="Tooltip">
                            This link</a> 
                        and <a href="#" class="tooltip-test" title="Tooltip">
                            that link</a> 
                        have tooltips on hover.</p>
                    <p><?php echo 'no';?></p>
                   <table class="table">
                    <tr>
                        <th>Date</th>
                        <td id="date"></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td id="fname"></td>
                    </tr>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                            data-dismiss="modal">
                        Fermer</button>
                    <button type="button" class="btn btn-primary">
                        Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
<script>
    $(document).ready(function(){
      
        $('#ajouter').show();
        
    });	
  </script>
</script>