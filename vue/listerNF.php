<form method="post" name='lister_nf' 
      action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=lister_nf" >
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
                $listeNF = DeclarantControleur::recupereNF();
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
                            <?php echo $mois_annee; ?></td>
                        <td data-title="Etat"> </td>		
                        <td> 
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Soumettre" style="display:inline-block;">
                                <button class="btn btn-success btn-xs" 
                                        data-title="Soumettre" data-toggle="modal" 
                                        data-target="#soumettre" >
                                    <span class="glyphicon glyphicon-ok">
                                    </span>
                                </button>
                            </p>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Modifier" style="display:inline-block;">
                                <button class="btn btn-primary btn-xs" 
                                        data-title="Modifier" data-toggle="modal" 
                                        data-target="#modifier" >
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Ajouter" style="display:inline-block;">
                                <button class="btn btn-warning btn-xs" 
                                        data-title="Ajouter" data-toggle="modal" 
                                        data-target="#ajouter" >
                                    <span class="glyphicon glyphicon-plus">  
                                    </span>
                                </button>
                            </p>
                            <p data-placement="rigth" data-toggle="tooltip" 
                               title="Supprimer" style="display:inline-block;">
                                <button class="btn btn-danger btn-xs" 
                                        data-title="Supprimer" data-toggle="modal" 
                                        data-target="#supprimer" >
                                    <span class="glyphicon glyphicon-trash">  
                                    </span>
                                </button>
                            </p>

                        </td>
                    </tr>
                    <?php
                }
                ?>	
                
            </tbody>
        </table>
    </div>
</form>
