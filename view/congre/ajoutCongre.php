<h1 class="text-center">Ajout d'un congrés </h1>
<form action="index.php?action=ajoutCongresTrait" method='post'>
    <div class="row mb-3">
        <label for="resume" class="col-lg-8 col-form-label">Nom : </label>
        <div class="col-sm-12">
            <input type="text" name="nom" id="nom" class="col-lg-6" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="avis" class="col-lg-4 col-form-label" required>Date début : </label>
        <div class="col-sm-12">
            <input type="date" name="dateDeb" id="dateDeb">
        </div>
    </div>
    <div class="row mb-3">
        <label for="avis" class="col-lg-4 col-form-label">Date fin : </label>
        <div class="col-sm-12">
            <input type="date" name="dateFin" id="dateFin" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="ville" class="col-lg-4 col-form-label">Ville : </label>
        <div class="col-sm-12">

            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="ville">
                <option value=""></option>
                <?php foreach ($lesVilles as $uneVille) {
                    $id = $uneVille->getNumInsee();
                    $lib = $uneVille->getNom();
                    // if (isset($leSuiviVilles) == true && $leSuiviVilles->getLeCongre()->getId() == $unCongre->getId())
                    //     echo ("<option selected value=$id>$lib</option>");
                    // else {
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