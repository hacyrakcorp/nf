<h2>Les fiches de frais soumisse</h2>
<div class="responsive-table-line">
    <form method="post" 
          name="NF_soumis" 
          action="<?php echo $this->getServerParam('PHP_SELF') ?>?page=tableauNFAction" 
          >
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
            <?php            
            foreach($tabNF as $nf)
            { /* @var $nf NoteDeFrais */
                ?>
                <tr> 
                    <input type="hidden" 
                           value="<?php echo $nf->getId(); ?>" 
                           name ="id" id="id">
                    <td data-title="Note de frais">
                        <?php
                        echo $nf->getMois_annee();
                        ?>
                    </td>
                    <td data-title="Declarant">
                        <?php
                        echo $nf->getId_utilisateur()->getNom()
                                ." ".
                               $nf->getId_utilisateur()->getPrenom() ;
                        ?>
                    </td>

                    <td data-title="Etat"> 
                        <?php echo $nf->getId_etat()->getLibelle(); ?>
                    </td>
                    <td>
                         <?php echo $nf->getTotal(); ?>
                    </td>
                    <td> 
                      <p data-placement="right" data-toggle="tooltip" 
                               title="Traiter la fiche de frais" 
                               style="display:inline-block;">
                                <button type="submit" 
                                        name = 'Traiter' 
                                        class="btn btn-primary btn-xs" 
                                        value ='<?php echo $nf->getId(); ?>'
                                        >
                                    <span class="glyphicon glyphicon-pencil">
                                    </span>
                                </button>
                            </p>
                    </td>
                </tr>
            <?php }
            ?>	
        </tbody>   
    </table>
    </form>
</div>