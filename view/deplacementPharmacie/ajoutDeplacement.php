<h1 class="text-center">Ajout d'une demande de déplacement chez une pharmacie</h1>
<form action="index.php?action=ajoutDeplacementPharmTrait" method='post'>
    <div class="row mb-3">
        <label for="date" class="col-lg-4 col-form-label">Date du déplacement :</label>
        <div class="col-sm-12">
            <input type="date" class="form-control" name="date_saisie" value=<?php if (isset($leDepl)) echo $leDepl->getDateSaisie()->format('Y-m-d') ?> placeholder="Date souhaitée (JJ/MM/AAAA)" id="date">
        </div> 
    </div>
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire :</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment" value="<?php if (isset($leDepl)) echo ($leDepl->getCommentaire()) ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label for="pharmacie" class="col-lg-4 col-form-label">Pharmacie :</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="pharmacie" ?>>
                <option value=" "></option>
                <?php foreach ($lesPharmacies as $unePharmacie) {
                    $id = $unePharmacie->getId();
                    $nom = $unePharmacie->getNom();
                    $rue = $unePharmacie->getRue();
                    $codePostal = $unePharmacie->getVille()->getCodePostal();
                    $nomVille = $unePharmacie->getVille()->getNomVille();
                    if (isset($leDepl) == true && $leDepl->getPharmacie()->getId()== $unePharmacie->getId())
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
            <select class="form-select form-select-md" name="produit" value=<?php if (isset($leDepl)) $leDepl->getProduit() ?>>
                <option value=" "></option>
                <?php foreach ($lesProduits as $unProduit) {
                    $id = $unProduit->getId();
                    $libelle = $unProduit->getLibelle();
                    if (isset($leDepl) == true && $leDepl->getProduit()->getId() == $unProduit->getId())
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