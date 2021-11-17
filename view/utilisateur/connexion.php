<!-- code html de la page-->
<form action="index.php?action=connexionTrait" method='post'>
    <div class="row mb-3">
        <label for="pseudo" class="col-sm-2 col-form-label">Pseudo</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pseudo" id="pseudo">
        </div>
    </div>
    <div class="row mb-3">
        <label for="motdepasse" class="col-sm-2 col-form-label">Mot de passe</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="motdepasse" id="motdepasse">
        </div>
    </div>
    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>

    </div>
</form>
<?php
if (isset($msgErr)) echo $msgErr;
?>