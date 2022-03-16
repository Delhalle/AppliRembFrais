<h1 class="text-center">Ajout des caractéristiques d'une participation à une conférence </h1>
<form action="index.php?action=ajoutSuiviCongreTrait" method='post'>
    <div class="row mb-3">
        <label for="resume" class="col-lg-4 col-form-label">Résumé : </label>
        <div class="col-sm-12">
            <textarea name="resume" required id="resume" cols="80" rows="5"><?php if (isset($leSuiviCongres)) {
                                                                                echo $leSuiviCongres->getResume();
                                                                            } ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="avis" class="col-lg-4 col-form-label">Avis : </label>
        <div class="col-sm-12">
            <textarea name="avis" required id="avis" cols="80" rows="5"><?php if (isset($leSuiviCongres)) {
                                                                            echo $leSuiviCongres->getAvis();
                                                                        } ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="congre" class="col-lg-4 col-form-label">Congré : </label>
        <div class="col-sm-12">

            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="congre">
                <?php foreach ($lesCongres as $unCongre) {
                    $id = $unCongre->getId();
                    $lib = $unCongre->getNom();
                    if (isset($leSuiviCongres) == true && $leSuiviCongres->getLeCongre()->getId() == $unCongre->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else {
                        echo ("<option value=$id>$lib</option>");
                    }
                } ?>
            </select>

        </div>
    </div>


    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>