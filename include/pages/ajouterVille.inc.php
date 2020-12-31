<h1>Ajouter une ville</h1>
<?php
if (empty($_POST["vil_nom"])) {
    ?>
    <form class="AjoutVille" action=# method="post">
        <label for="NomVille">Nom : </label>
        <input class="text" type="text" name="vil_nom" title="Nom :">
        <input class="valider" type="submit" name="ValiderVille" value="Valider">
    </form>
    <?php
} else {
    $pdo = new Mypdo();
    $villeManager = new VilleManager($pdo);
    $ville = new Ville($_POST);
    $retour = $villeManager->add($ville);

    if ($retour != 0) {
        echo "<img class=\"imgvalid\" src=\"image/valid.png\" alt=\"Valider\">";
        echo "La ville \"<span class=\"bold\">" . $_POST["vil_nom"] . "</span>\" a été ajoutée";
    } else {
        echo "<img class=\"imgvalid\" src=\"image/erreur.png\" alt=\"Valider\">";
        echo "La ville \"<span class=\"bold\">" . $_POST["vil_nom"] . "</span>\" n'a pas pu être ajoutée";
    }
}
?>
