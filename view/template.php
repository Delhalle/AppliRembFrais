<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title><?= $title ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4 nav-justified">
    <div class="container-fluid">
      <a class="navbar-brand">Gestion des frais</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
      if (isset($_SESSION['profil']) == true) {
        // meilleure manière de faire
        // $ficnav = 'nav' . $_SESSION['profil'] . '.html';
        // include $ficnav;
        switch ($_SESSION['profil']) {
          case 1:
            // profil
            include 'nav1.html';
            break;
          case 2:
            include 'nav2.html';
            break;
          case 3:
            include 'nav3.html';
            break;
          case 4:
            include 'nav4.html';
            break;
        }
      }
      ?>
    </div>
  </nav>
  <div class="container-sm pt-3 border">
    <?= $content ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>