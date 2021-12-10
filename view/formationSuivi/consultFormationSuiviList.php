<!-- code html de la page-->
<h1 class="text-center">Consultation d'une formation suivie</h1>
<form action="index.php?action=consultFormationForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDelegues) == 0) {
            echo ("Aucun utilisateur à saisie de formation");
        } else {
        ?>
           <label for="lesDel" class="col-lg-4 col-form-label">Choisissez le délégué qui a suivi une formation ou plusieurs</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDel">
                <option value=""></option>
                    <?php foreach ($lesDelegues as $unDelegue) {
                        $id = $unDelegue->getId();
                        $nom = $unDelegue->getNom() . ' ' . $unDelegue->getPrenom();
                            echo ("<option value=$id>$nom</option>");
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