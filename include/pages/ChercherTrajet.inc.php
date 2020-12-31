<h1>Rechercher un trajet</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
if (empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['depart']) && empty($_POST['precision']) && empty($_POST['heure'])) { ?>
    <form action="index.php?page=10" method="post">
        <label for="vildepart"> Ville de départ : </label><br><br>
        <select onchange="this.form.submit()" id="vildepart" name="vildepart" class="liste">
            <option value="">Choisissez</option>
            <?php
            $proposeManager = new ProposeManager($pdo);
            $listeVille = $proposeManager->villeEnDepart();
            foreach ($listeVille as $ville) { ?>
                <option value=<?php echo '"' . $ville->getVilNum() . '"'; ?>><?php echo $ville->getVilNom(); ?></option>
            <?php } ?>
        </select>
    </form>
    <?php
} else if (!empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['depart']) && empty($_POST['precision']) && empty($_POST['heure'])) {
    $villeDepart = $villeManager->vilInfo($_POST['vildepart']);
    $listeVilleArrive = $villeManager->rechercheVilArr($_POST['vildepart']);
    $_SESSION['vildepart'] = $_POST['vildepart']; ?>
    <form action="index.php?page=10" method="post" id="gridForm">
        <div data-children-count="1">
            <label for="vildepart">Ville de départ :</label>
            <label for=""><?php echo $villeDepart->getVilNom(); ?></label>

            <label for="vilarr">Ville d'arrivée : </label>
            <select name="vilarr" class="liste">
                <?php foreach ($listeVilleArrive as $ville) { ?>
                    <option value=<?php echo $ville->getVilNum() ?>><?php echo $ville->getVilNom() ?></option>
                <?php } ?>
            </select>
        </div>
        <div data-children-count="2">
            <label>Date de départ :</label>
            <input type="text" id="depart" name="depart" class="text" value=<?php echo '"' . date("d/m/Y") . '"'; ?>/>
            <label>Précision :</label>
            <select name="precision" class="liste">
                <option value="0">Ce jour</option>
                <option value="1">+/- 1 jour</option>
                <option value="2">+/- 2 jour</option>
                <option value="3">+/- 3 jour</option>
            </select>
            <label>A partir de :</label>
            <select name="heure" class="liste">
                <?php for ($i = 0; $i < 24; $i++) { ?>
                    <option value=<?php echo '"' . $i . '"'; ?>><?php echo $i . "h"; ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Valider" class="valider"/>
    </form>
    <?php
} else if (empty($_POST['vildepart']) && !empty($_POST['vilarr']) && !empty($_POST['depart']) && isset($_POST['precision']) && isset($_POST['heure'])) {
    $parcoursManager = new ParcoursManager($pdo);
    $parEtSens = $parcoursManager->ParVil1Vil2($_SESSION['vildepart'], $_POST['vilarr']);
    $precision = $_POST['precision'];
    $date = getEnglishDate($_POST['depart']);
    $heure = $_POST['heure'];

    $proposeManager = new ProposeManager($pdo);
    $liste = $proposeManager->trajetAccepte($parEtSens['parcours'], $date, $precision, $heure, $parEtSens['sens']);
    $personneManager = new PersonneManager($pdo);

    if (!empty($liste)) { ?>
        <table>
            <tr>
                <th>Ville de départ</th>
                <th>Ville d'arrivée</th>
                <th>Date de départ</th>
                <th>Heure de départ</th>
                <th>Nb place(s)</th>
                <th>Nom du covoitureur</th>
            </tr>
            <?php
            foreach ($liste as $num) {
                $personne = $personneManager->getPersonneNum($num->getPerNum());


                ?>
                <tr>
                    <td><?php echo $_SESSION['vildepart']; ?></td>
                    <td><?php echo $_POST['vilarr']; ?></td>
                    <td><?php echo $num->getProDate(); ?></td>
                    <td><?php echo $num->getProTime(); ?></td>
                    <td><?php echo $num->getProPlace(); ?></td>
                    <td><?php echo $personne->getPerNom(); ?></td>
                </tr>
                <?php
            } ?>
        </table>

        <?php
    } else {
        ?>
        <p><img src="image/erreur.png" alt="erreur"/>Il n'y a pas de trajet :(</p>
        <?php
    }
} ?>
