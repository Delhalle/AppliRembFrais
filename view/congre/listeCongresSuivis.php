<!-- code html de la page-->
<h2 class="text-center">Les congrès disponibles en <?= $paysChoisie->getLibelle(); ?> </h2>

<?php
if (count($lesCongres) == 0) {
    echo ("Il n'y a aucun congrès dans ce pays");
} else {

?>

    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">Nom</th>
                <th scope="col">Date de début</th>
                <th scope="col">Date de fin</th>

            </tr>
        </thead>

        <?php

        foreach ($lesCongres as $unCongre) {
            $dateDeb =  $unCongre->getDateDebut();
            $dateFin =  $unCongre->getDateFin();


            $dateD = $dateDeb->format('d/m/Y');
            $dateF = $dateFin->format('d/m/Y');

            echo ("<tr>");
            echo ("<td>" . $unCongre->getNom() . "</td>");
            echo ("<td>" . $dateD . "</td>");
            echo ("<td>" . $dateF  . "</td>");

            echo ("</tr>");
        }

        ?>

    </table>
<?php
}
?>