<!-- code html de la page-->
<h1 class="text-center">Modification d'une formation suivi</h1>
<form action="index.php?action=modifFormationSuiviList" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesFormSuivi) == 0) {
            echo ("Vous n'avez suivi aucune formation");
        } else {
        ?>
            <label for="lesFormSuivi" class="col-lg-4 col-form-label">Choisissez la formation suivi à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listFormSuivi">
                    <?php foreach ($lesFormSuivi as $uneFormationSuivi) {
                        $id = $uneFormationSuivi->getId();
                        $libelle = $uneFormationSuivi->getTypeFrais()->getLibelle() . ' , montant : ' . $uneFormationSuivi->getMontant();
                        if (isset($_POST['listFormSuivi']) == true && $_POST['listFormSuivi'] == $id)
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