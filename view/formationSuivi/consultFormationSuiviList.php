<!-- code html de la page-->
<h1 class="text-center">Consultation d'une formation suivie</h1>
<form action="index.php?action=consultFormationForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDemandes) == 0) {
            echo ("L'utilisateur n'a pas saisie de formation suivi");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez le délégués médicaux</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDel">
                    <?php foreach ($lesFormationsSuivi as $uneFormationSuivi) {
                        $id = $uneFormationSuivi->getId();
                        $nom = $uneFormationSuivi->getDelegue()->getNom() . ' , Service : ' . $uneFormationSuivi->getDelegue()->getPrenom();
                        if (isset($_POST['listFormSuivi']) == true && $_POST['listFormSuivi'] == $id)
                            echo ("<option selected value=$id>$nom</option>");
                        else
                            echo ("<option value=$id>$nom</option>");
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