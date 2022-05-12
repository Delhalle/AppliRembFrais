<!-- code html de la page-->
<h1 class="text-center">Suppression d'une formation suivi</h1>
<form action="index.php?action=suppFormSuiviTrait" method='post'>
    <input type="hidden" name="idFormSuivi" value="<?php if ($laFormSuivi != null) echo $laFormSuivi->getId(); ?>" <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" value="<?php if ($laFormSuivi != null) echo $laFormSuivi->getCommentaire(); ?>" id="comment">
        </div>
    <div class="row mb-3">
        <label for="formation" class="col-lg-4 col-form-label">Formation</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="formation">
                <?php foreach ($lesFormations as $uneFormation) {
                    $id = $uneFormation->getId();
                    $lib = $uneFormation->getFormation();
                    if ($laFormSuivi != null) {
                        $idFormation = $laFormSuivi->getFormation()->getId();
                    } else {
                        $idFormation = 0;
                    }
                    if ($id == $idFormation)
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
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