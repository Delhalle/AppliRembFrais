<!-- code html de la page-->
<h1 class="text-center">Modification d'un déplacement chez un pharmacien</h1>
<form action="index.php?action=modifDeplacementPharmTrait" method='post'>
    <input type="hidden" name="idDeplacement" value="<?php if ($leDeplacement != null) echo $leDeplacement->getId(); ?>" <div class="row mb-3">
    <div class="row mb-3">
        <label for="date" class="col-lg-4 col-form-label">Date du déplacement :</label>
        <div class="col-sm-12">
            <input type="date" class="form-control" name="date_saisie" value=<?php if ($leDeplacement != null) echo $leDeplacement->getDateSaisie()->format('Y-m-d'); ?> id="date">
        </div> 
    </div>

    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire :</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" value="<?php if ($leDeplacement != null) echo $leDeplacement->getCommentaire(); ?>" id="comment">
        </div>
    </div>

    <div class="row mb-3">
        <label for="pharmacie" class="col-lg-4 col-form-label">Pharmacie :</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="pharmacie">
                <?php foreach ($lesPharmacies as $unePharmacie) {
                    $id = $unePharmacie->getId();
                    $nom = $unePharmacie->getNom();
                    $rue = $unePharmacie->getRue();
                    $codePostal = $unePharmacie->getVille()->getCodePostal();
                    $nomVille = $unePharmacie->getVille()->getNomVille();
                    if ($leDeplacement != null) {
                        $idPharmacieDem = $leDeplacement->getPharmacie()->getId();
                    } else {
                        $idPharmacieDem = 0;
                    }
                    if ($id == $idPharmacieDem)
                        echo ("<option selected value=$id>$nom, $rue, $nomVille $codePostal</option>");
                    else
                        echo ("<option value=$id>$nom, $rue, $nomVille $codePostal</option>");
                } ?>
            </select>
        </div>
    </div>
   
    <div class="row mb-3">
        <label for="produit" class="col-lg-4 col-form-label">Produit :</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="produit">
                <?php foreach ($lesProduits as $unProduit) {
                    $id = $unProduit->getId();
                    $libelle = $unProduit->getLibelle();
                    if ($leDeplacement != null) {
                        $idProduitDem = $leDeplacement->getProduit()->getId();
                    } else {
                        $idProduitDem = 0;
                    }
                    if ($id == $idProduitDem)
                        echo ("<option selected value=$id>$libelle</option>");
                    else
                        echo ("<option value=$id>$libelle</option>");
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