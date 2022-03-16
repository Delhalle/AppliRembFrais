<!-- code html de la page-->
<h2 class="text-center">Liste des congrès suivis</h2>


<form action="index.php?action=modifSuiviForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesCongres) == 0) {
            echo ("Vous n'avez saisi aucun congrès");
        } else {
        ?>
            <label for="congres" class="col-lg-4 col-form-label">Congrès : </label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" name="congres" onChange="submit()">
                    <option value=""></option>

                    <?php

                    foreach ($lesCongres as $unCongre) {
                        $dateDeb =  $unCongre->getDateDebut();
                        $dateFin =  $unCongre->getDateFin();

                        $dateD = $dateDeb->format('d/m/Y');
                        $dateF = $dateFin->format('d/m/Y');

                        $id = $unCongre->getId();
                        $lib = $unCongre->getNom() . " " . $dateD . " " . $dateF;

                        echo ("<option value=$id> $lib    </option>");
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