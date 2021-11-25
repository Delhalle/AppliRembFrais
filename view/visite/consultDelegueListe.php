<!-- code html de la page-->
<h1 class="text-center">Consultation des visites</h1>
<form action="index.php?action=consultVisite" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDelegues) == 0) {
            echo ("Vous n'avez saisi aucun délégué");
        } else {
        ?>
            <label for="lesDel" class="col-lg-4 col-form-label">Choisissez le délégué pour voir ses visites</label>
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