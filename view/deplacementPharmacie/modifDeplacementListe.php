<!-- code html de la page-->
<h1 class="text-center">Modification d'un déplacement chez un pharmacien</h1>
<form action="index.php?action=modifDeplacementPharmForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDeplacements) == 0) {
            echo ("Vous n'avez saisi aucun deplacement");
        } else {
        ?>
            <label for="lesDepl" class="col-lg-4 col-form-label">Choisissez la deplacement à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDeplPharm">
                    <option value="" ></option>
                    <?php foreach ($lesDeplacements as $unDeplacement) {
                        $id = $unDeplacement->getId();
                        $date_saisie = $unDeplacement->getDateSaisie()->format('d-m-Y').",";
                        $Pharmacie = $unDeplacement->getPharmacie()->getNom() . ', adresse : ' . $unDeplacement->getPharmacie()->getRue() . " " . $unDeplacement->getPharmacie()->getVille()->getCodePostal() ." ". $unDeplacement->getPharmacie()->getVille()->getNomVille().",";
                        $Produit = "produit : " .$unDeplacement->getProduit()->getLibelle();
                            echo ("<option value=$id>$dateSaisie $Pharmacie $Produit</option>");
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