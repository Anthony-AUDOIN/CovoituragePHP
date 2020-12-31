<?php
$pdo = new Mypdo();
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);

if (!empty($_POST['annee']) && !empty($_POST['departement'])) {
    $etudiant = new Etudiant(array('per_num' => $_POST['idEtu'], 'dep_num' => $_POST['departement'], 'div_num' => $_POST['annee']));
    $retour = $etudiantManager->add($etudiant);
}

if (!empty($_POST['sal_telprof']) && !empty($_POST['fonction'])) {
    $salarie = new Salarie(array('per_num' => $_POST['idEtu'], 'sal_telprof' => $_POST['sal_telprof'], 'fon_num' => $_POST['fonction']));
    $retour = $salarieManager->add($salarie);
}

if (empty($_POST["per_nom"]) || empty($_POST["per_prenom"]) || empty($_POST["per_tel"]) || empty($_POST["per_mail"]) || empty($_POST["per_login"]) || empty($_POST["per_pwd"])) {
    ?>
    <h1>Ajouter une personne</h1>
    <form class="AjoutPersonne" action=# method="post">
        <div id="center">
            <label for="per_nom">Nom : </label>
            <input id="per_nom" class="text" type="text" name="per_nom">

            <label for="per_prenom">Prenom : </label>
            <input id="per_prenom" class="text1" type="text" name="per_prenom"> <br><br>

            <label for="per_tel">Téléphone : </label>
            <input id="per_tel" class="text" type="tel" pattern="[0][0-9][0-9]{8}" name="per_tel">

            <label for="per_mail">Mail : </label>
            <input id="per_mail" class="text1" type="email" name="per_mail"> <br><br>

            <label for="per_login">Login : </label>
            <input id="per_login" class="text" type="text" name="per_login">

            <label for="per_pwd">Mot de passe : </label>
            <input id="per_pwd" class="text1" type="password" name="per_pwd"> <br><br>
        </div>
        <label for="categorie">Catégorie : </label>

        <input type="radio" name="categorie" value="1" checked>
        <label for="etudiant">Etudiant</label>
        <input type="radio" name="categorie" value="2">
        <label for="personnel">Personnel</label> <br><br>
        <input class="valider" type="submit" name="ValiderPersonne" value="Valider">
    </form>
    <?php
} else {
    $personneManager = new PersonneManager($pdo);
    $personne = new Personne($_POST);
    $villeManager = new VilleManager($pdo);
    $retour = $personneManager->add($personne);
    $num = $pdo->lastInsertId();

    if ($_POST['categorie'] == 1) {
        $departementManager = new DepartementManager($pdo);
        $divisionManager = new DivisionManager($pdo);
        $departements = $departementManager->getAllDepartement();
        $divisions = $divisionManager->getAllDivision();


        if (empty($_POST['annee']) || empty($_POST['departement'])) {
            ?>

            <h1>Ajouter un étudiant</h1>
            <form class="AjoutEtudiant" action=# method="post">
                <label for="année">Année : </label>
                <select class="liste" name="annee">
                    <?php
                    foreach ($divisions as $division) {
                        echo "<option value=" . $division->getDivNum() . ">" . $division->getDivNom() . "</option> \n";
                    } ?>
                </select> <br><br>
                <label for="departement">Département : </label>
                <select class="liste" name="departement" id="departement">
                    <?php
                    foreach ($departements as $departement) {
                        $vil_num = $departement->getVilNum();
                        $vil_nom = $villeManager->vilInfo($vil_num);
                        echo "<option value=" . $departement->getDepNum() . ">" . $departement->getDepNom() . " (" . $vil_nom->getVilNom() . ")" . "</option> \n";
                    } ?>
                </select> <br><br>
                <input type="hidden" name="idEtu" value="<?php echo $num ?>">
                <input class="valider" type="submit" name="ValiderEtudiant" value="Valider">
            </form>

            <?php

        }
    } else {
        $fonctionManager = new FonctionManager($pdo);
        $fonctions = $fonctionManager->getAllFonction();

        ?>
        <h1>Ajouter un salarié</h1>
        <form class="AjoutSalarie" action=# method="post">
            <label for="sal_telprof">Téléphone professionnel : </label>
            <input required pattern="[0][0-9][0-9]{8}" id="sal_telprof" class="text" type="tel"
                   name="sal_telprof"><br><br>
            <label for="fonction">Fonction : </label>
            <select class="liste" name="fonction">
                <?php
                foreach ($fonctions as $fonction) {
                    echo "<option value=" . $fonction->getFonNum() . ">" . $fonction->getFonLib() . "</option> \n";
                } ?>
            </select><br><br>
            <input type="hidden" name="idEtu" value="<?php echo $num ?>">
            <input class="valider" type="submit" name="ValiderSalarie" value="Valider">
        </form>
        <?php

    }
}
?>
