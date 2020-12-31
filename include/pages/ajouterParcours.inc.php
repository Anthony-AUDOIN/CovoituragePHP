<h1>Ajouter un parcours</h1>
<?php
$pdo = new Mypdo();
if (empty($_POST["vil_num1"]) || empty($_POST["vil_num2"]) || empty($_POST["par_km"]) && $_POST["vil_num1"] == $_POST["vil_num2"]) {

    $villeManager = new VilleManager($pdo);
    $villes = $villeManager->getAllVille();
    $parcoursManager = new ParcoursManager($pdo);
    $ville1 = $parcoursManager->getVille1();
    $ville2 = $parcoursManager->getVille2();

    ?>
    <form class="AjoutVille" action=# method="post">
        <label for="vil_num1">Ville 1 : </label>
        <select class="liste" name="vil_num1">
            <?php
            foreach ($villes as $ville) {
                echo "<option value=" . $ville->getVilNum() . ">" . $ville->getVilNom() . "</option> \n";
            } ?>
        </select>
        <label for="vil_num2">Ville 2 : </label>
        <select class="liste" name="vil_num2">
            <?php
            foreach ($villes as $ville) {
                echo "<option value=" . $ville->getVilNum() . ">" . $ville->getVilNom() . "</option> \n";
            } ?>
        </select>
        <label for="par_km">Nombre de kilomètre(s)</label>
        <input class="text" type="number" name="par_km" min="0"> <br><br>
        <input class="valider" type="submit" name="ValiderParcours" value="Valider">
    </form>

    <?php
} else {
    $parcoursManager = new ParcoursManager($pdo);
    $parcours = new Parcours($_POST);
    $retour = $parcoursManager->add($parcours);
    if ($retour != 0) {
        echo "<img class\"imgvalid\" src=\"image/valid.png\" alt=\"Valider\">";
        echo "Le parcours a été ajouté";
    } else {
        echo "<img class\"imgvalid\" src=\"image/erreur.png\" alt=\"Erreur\">";
        echo "Le parcours n'a pas pu être ajoutée";
    }
}
?>
