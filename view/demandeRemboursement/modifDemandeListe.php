<!-- code html de la page-->
<h1 class="text-center">Modification d'une demande de remboursement</h1>
<form action="index.php?action=modifDemRembForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDemandes) == 0) {
            echo ("Vous n'avez saisi aucune demande");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez la demande à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDemRemb">
                    <?php foreach ($lesDemandes as $uneDemande) {
                        $id = $uneDemande->getId();
                        $libelle = $uneDemande->getTypeFrais()->getLibelle() . ' , montant : ' . $uneDemande->getMontant();
                        if (isset($_POST['listDemRemb']) == true && $_POST['listDemRemb'] == $id)
                            echo ("<option selected value=$id>$libelle</option>");
                        else
                            echo ("<option value=$id>$libelle</option>");
                    } ?>
                </select>

            </div>
        <?php
        }
        ?>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>