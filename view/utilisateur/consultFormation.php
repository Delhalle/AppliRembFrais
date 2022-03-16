<!-- code html de la page-->
<h2 class="text-center">Liste des congrès suivies par les délégués</h2>


<form action="index.php?action=listeFormationsSuivi" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesUtilisateurs) == 0) {
            echo ("Vous n'avez saisi aucun utilisateur");
        } else {
        ?>
            <label for="utilisateur" class="col-lg-4 col-form-label">Utilisateurs : </label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" name="utilisateur" onChange="submit()">
                    <option value=""></option>
                    <?php foreach ($lesUtilisateurs as $unUtilisateur) {
                        $id = $unUtilisateur->getId();
                        $lib = $unUtilisateur->getNom() . " " . $unUtilisateur->getPrenom();

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