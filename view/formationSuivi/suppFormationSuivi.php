<!-- code html de la page-->
<h1 class="text-center">Suppression d'une formation suivi</h1>
<form action="index.php?action=suppFormSuiviTrait" method='post'>
    <input type="hidden" name="idFormSuivi" value="<?php if ($laFormSuivi != null) echo $laFormSuivi->getId(); ?>" <div class="row mb-3">



    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">date de saisie</th>
                <th scope="col">type de frais</th>
                <th scope="col">commentaire</th>
            </tr>
        </thead>
        <?php if ($laFormSuivi != null) {
            echo ("<tr>");
            echo ("<td>" . $laFormSuivi->getDateSaisie() . "</td>");
            echo ("<td>" . $laFormSuivi->getFormation()->getFormation() . "</td>");
            echo ("<td>" . $laFormSuivi->getCommentaire()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Supprimer</button>
        </div>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>