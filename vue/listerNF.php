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
               
            </tbody>
        </table>
    </div>
</form>
<?php
    $declarant = new DeclarantControleur();
    $listeNF = $declarant->recupereNF();
?>