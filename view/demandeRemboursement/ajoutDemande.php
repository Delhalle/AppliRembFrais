<h1 class="text-center">Ajout d'une demande de remboursement</h1>
<form action="index.php?action=ajoutDemRembTrait" method='post'>
    <div class="row mb-3">
        <label for="montant" class="col-lg-4 col-form-label">Montant du remboursement</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="montant" id="montant" value="<?php if (isset($laDemande)) echo $laDemande->getMontant()?>">
        </div>                    
    </div>
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment">
        </div>
    </div>
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Type de frais</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="typeFrais">
                <?php foreach ($lesTypesFrais as $unType) {
                    $id = $unType->getId();
                    $lib = $unType->getLibelle();
                    if (isset($laDemande) == true && $laDemande->getTypeFrais()->getId() == $unType->getId())
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