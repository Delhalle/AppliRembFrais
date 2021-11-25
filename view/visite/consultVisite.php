<!-- code html de la page-->
<h2 class="text-center">Les visites des délégués</h2>

<?php
if (count($lesVisites) == 0) {
    echo ("Vous n'avez saisi aucune visite");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">Date de saisie</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Médecin</th>
            </tr>
        </thead>
        <?php foreach ($lesVisites as $uneVisite) {
            echo ("<tr>");
            echo ("<td>" . $uneVisite->getDate() . "</td>");
            echo ("<td>" . $uneVisite->getCommentaire() . "</td>");
            echo ("<td>" . $uneVisite->getMedecin()->getNom() . " " . $uneVisite->getMedecin()->getPrenom() ."</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>