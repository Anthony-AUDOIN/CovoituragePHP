<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$_SESSION["connecter"] = false;
if (empty($_POST["codeResult"])) {

    ?>
    <h1>Pour vous connecter</h1>
    <form class="AjoutPersonne" action=# method="post">
        <label for="per_login">Nom d'utilisateur : </label> <br>
        <input id="per_login" class="text" type="text" name="per_login"><br><br>

        <label for="per_pwd">Mot de passe : </label><br>
        <input id="per_pwd" class="text" type="password" name="per_pwd"><br>
        <br>
        <img class="connection" src="./image/nb/<?php $_SESSION["numero1"] = random_int(1, 9);
        echo $_SESSION["numero1"]; ?>.png" alt="Image1">
        <span class="password">+</span>
        <img class="connection" src="./image/nb/<?php $_SESSION["numero2"] = random_int(1, 9);
        echo $_SESSION["numero2"]; ?>.png" alt="Image2">
        <span class="password">=</span>
        <br>
        <input type="number" min="0" class="text" name="codeResult"><br><br>
        <input class="valider" type="submit" name="ValiderConnection" value="Valider">
    </form> <br>

    <?php
} else {
    if (($_POST["codeResult"] == $_SESSION["numero1"] + $_SESSION["numero2"]) && $personneManager->valide($_POST["per_login"], $_POST["per_pwd"]) == 1) {
        unset($_SESSION["numero1"]);
        unset($_SESSION["numero2"]);
        $personne = serialize($personneManager->info($_POST["per_login"]));
        $connect = unserialize($personne);
        $_SESSION["login"] = $connect->getPerLog();
        $_SESSION["num"] = $connect->getPerNum();
        $_SESSION["connecter"] = true;
        header("Location: index.php");
    }
}
?>