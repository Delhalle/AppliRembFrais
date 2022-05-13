<!-- code html de la page-->
<h1 class="text-center">Suppression d'une formation suivi</h1>
<form action="index.php?action=suppFormSuiviForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesFormationsSuivi) == 0) {
            echo ("Vous n'avez suivi aucune formation");
        } else {
        ?>
            <label for="lesFormationsSuivi" class="col-lg-4 col-form-label">Choisissez la formation suivi à supprimer</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listFormSuivi">
                <option value="" ></option>
                    <?php foreach ($lesFormationsSuivi as $uneFormationSuivi) {
                        $id = $uneFormationSuivi->getId();
                        $libelle = $uneFormationSuivi->getFormation()->getFormation();
                        $commentaire = $uneFormationSuivi->getCommentaire();
                        if (isset($_POST['listFormSuivi']) == true && $_POST['listFormSuivi'] == $id)
                            echo ("<option selected value=$id>$libelle Commentaire : $commentaire</option>");
                        else
                            echo ("<option value=$id>$libelle Commentaire : $commentaire</option>");
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