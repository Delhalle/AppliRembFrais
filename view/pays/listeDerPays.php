<!-- code html de la page-->
<h2 class="text-center">Liste des congrès par pays </h2>


<form action="index.php?action=consultCongresPayss" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesPays) == 0) {
            echo ("Vous n'avez saisi aucun congrès");
        } else {
        ?>
            <label for="pays" class="col-lg-4 col-form-label">Pays : </label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" name="pays" onChange="submit()">
                    <option value=""></option>

                    <?php

                    foreach ($lesPays as $unPays) {


                        $id = $unPays->getId();
                        $lib = $unPays->getLibelle();

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