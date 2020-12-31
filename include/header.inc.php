<!doctype html>
<html lang="fr">
<link rel="icon" href="image/logo.png">
<head>
    <meta charset="utf-8">
    <?php
    $title = "Bienvenue sur le site de covoiturage de l'IUT."; ?>
    <title>
        <?php echo $title ?>
    </title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>
</head>
<body>
<div id="header">
    <div id="connect">
        <?php
        if (empty($_SESSION["connecter"])) {
            ?>
            <label><a href="index.php?page=11">Connexion</a></label>
            <?php
        } else {
            ?>
            utilisateur : <label><?php echo $_SESSION["login"]; ?></label><br>
            <label><a href="index.php?page=12">Deconnexion</a></label>

            <?php
        } ?>
    </div>
    <div id="entete">
        <div class="colonne">
            <a href="index.php?page=0">
                <img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin"/>
            </a>
        </div>
        <div class="colonne">
            Covoiturage de l'IUT,<br/>Partagez plus que votre véhicule !!!
        </div>
    </div>
</div>
