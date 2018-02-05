<h2>Fiches de frais soumises</h2>
<?php if ($tabNFSoumis != null): ?>
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
            <?php foreach($tabNFAll as $nf) : ?>
            <?php if ($nf->getId_etat()->getId() == Etat::SOUMIS_ID):?>
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
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>   
    </table>
    </form>
</div>
<?php else : ?>
<p>Pas de fiche de frais soummise</p>
<?php endif; ?>

<!-- ---------------------------------------------------------------------- !-->
<h2>Fiches de frais en cours de traitement</h2>
<?php if ($tabNFEnCours != null): ?>
<div class="responsive-table-line">
    <form method="post" 
          name="Liste_nf" 
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
            <?php foreach($tabNFAll as $nf) : ?>
            <?php if ($nf->getId_etat()->getId() == Etat::ENCOURS_ID):?>
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
                <?php endif; ?>
            <?php endforeach;?>	
        </tbody>   
    </table>
    </form>
</div>
<?php else : ?>
<p>Pas de fiche de frais en cours de traitement</p>
<?php endif; ?>

<!-- ---------------------------------------------------------------------- !-->
<h2>Fiches de frais traitées</h2>
<?php if ($tabNFTraite != null): ?>
<div class="responsive-table-line">
    <form method="post" 
          name="Liste_nf" 
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
            <?php foreach($tabNFAll as $nf) : ?>
            <?php if ($nf->getId_etat()->getId() == Etat::TRAITER_ID):?>
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
                <?php endif; ?>
            <?php endforeach;?>	
        </tbody>   
    </table>
    </form>
</div>
<?php else : ?>
<p>Pas de fiche de frais traitée</p>
<?php endif; ?>