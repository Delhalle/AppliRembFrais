<!-- code html de la page-->
<h2 class="text-center">Vos formation suivi</h2>

<?php
if (count($lesFormSuivi) == 0) {
    echo ("Vous n'avez saisi aucune formation suivi");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">date de saisie</th>
                <th scope="col">type de frais</th>
                <th scope="col">montant</th>
                <th scope="col">commentaire</th>
            </tr>
        </thead>
        <?php foreach ($lesFormSuivi as $uneFormSuivi) {
            echo ("<tr>");
            echo ("<td>" . $uneFormSuivi->getDateSaisie() . "</td>");
            echo ("<td>" . $uneFormSuivi->getFormation()->getFormation() . "</td>");
            echo ("<td>" . $uneFormSuivi->getCommentaire()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>