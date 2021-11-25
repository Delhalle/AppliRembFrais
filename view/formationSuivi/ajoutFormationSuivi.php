<h1 class="text-center">Ajout d'une formation suivi</h1>
<form action="index.php?action=ajoutFormSuiviTrait" method="post">
<div class="row mb-3">
        <label for="montant" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="montant" value="<?php if (isset($_POST['montant']) == true) echo $_POST['montant']; ?>" id="montant">
        </div>
    </div>
    <div class="row mb-3">
        <label for="formation" class="col-lg-4 col-form-label">Nom de la formation</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="formation">
                <?php foreach ($lesFormation as $uneFormation) {
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
    <div class="row mb-3">
        <label for="delegue" class="col-lg-4 col-form-label">Nom et Prénom du delegue</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="delegue">
                <?php foreach ($lesDelegues as $unDelegue) {
                    $id = $unDelegue->getId();
                    $nom = $unDelegue->getNom();
                    $prenom = $unPrenom->getPrenom();
                    if (isset($_POST['delegue']) == true && $_POST['delegue'] == $unDelegue->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
            </select>
        </div>
    </div>
    
</form>