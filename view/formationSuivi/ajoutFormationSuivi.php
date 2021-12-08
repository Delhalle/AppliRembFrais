<h1 class="text-center">Ajout d'une formation suivi</h1>
<form action="index.php?action=ajoutFormSuiviTrait" method="post">
<div class="row mb-3">
        <label for="commentaire" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" value="<?php if (isset($_POST['commentaire']) == true) echo $_POST['commentaire']; ?>" id="commentaire">
        </div>
    </div>
    <div class="row mb-3">
        <label for="commentaire" class="col-lg-4 col-form-label">Note</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" name="note" value="<?php if (isset($_POST['note']) == true) echo $_POST['note']; ?>" id="note">
        </div>
    </div>
    <div class="row mb-3">
        <label for="formation" class="col-lg-4 col-form-label">Nom de la formation</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="formation">
                <?php foreach ($lesFormations as $uneFormation) {
                    $id = $uneFormation->getId();
                    $form = $uneFormation->getFormation();
                    if (isset($_POST['formation']) == true && $_POST['formation'] == $unType->getId())
                        echo ("<option selected value=$id>$form</option>");
                    else
                        echo ("<option value=$id>$form</option>");
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