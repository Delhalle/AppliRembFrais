<!-- code html de la page-->
<h1 class="text-center">Liste des déplacements chez des pharmacies</h1>
<form action="index.php?action=consultDelegueDeplacementPharm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDelegues) == 0) {
            echo ("Ce délégué n'a saisie aucun déplacement");
        } else {
        ?>
            <label for="lesDelegues" class="col-lg-4 col-form-label">Choisissez le délégué à visualiser :</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDelegueDeplacementPharm">
                <option value=" "></option>
                    <?php foreach ($lesDelegues as $unDelegue) {
                        $id = $unDelegue->getId();
                        $nom = $unDelegue->getNom();
                        $prenom = $unDelegue->getPrenom();
                            echo ("<option value=$id>$nom $prenom</option>");
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