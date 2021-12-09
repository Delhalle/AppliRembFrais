<!-- code html de la page-->
<h2 class="text-center">Les déplacements chez les médecins</h2>

<?php
if (count($lesDeplacements) == 0) {
    echo ("Ce délégué n'a saisie aucun déplacement");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">date de saisie</th>
                <th scope="col">commentaire</th>
                <th scope="col">pharmacie</th>
                <th scope="col">produit</th>
            </tr>
        </thead>
        <?php foreach ($lesDeplacements as $leDeplacement) {  
            echo ("<tr>");
            echo ("<td>" . $leDeplacement->getDateSaisie()->format('d-m-Y') . "</td>");
            echo ("<td>" . $leDeplacement->getCommentaire()  . "</td>");
            echo ("<td>" . $leDeplacement->getPharmacie()->getNom() . " , " . $leDeplacement->getPharmacie()->getRue() . " " .$leDeplacement->getPharmacie()->getVille()->getNomVille() . " " .$leDeplacement->getPharmacie()->getVille()->getCodePostal() . "</td>");
            echo ("<td>" . $leDeplacement->getProduit()->getLibelle() . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>