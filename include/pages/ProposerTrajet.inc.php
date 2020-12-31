<h1>Proposer un trajet</h1>
<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
if (empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['dateDep']) && empty($_POST['hDep']) && empty($_POST['nbPlaces'])) {
    $listeVilleDepart = $villeManager->vilDep();
    ?>
    <form action="index.php?page=9" method="post">
        <label for="vildepart">Ville de départ :</label><br><br>
        <select onchange="this.form.submit()" id="vildepart" name="vildepart" class="liste">
            <option value="">Choisissez</option>
            <?php foreach ($listeVilleDepart as $ville) { ?>
                <option value=<?php echo $ville->getVilNum() ?>><?php echo $ville->getVilNom() ?></option>
            <?php } ?>
        </select>
    </form>
    <?php
} else if (!empty($_POST['vildepart']) && empty($_POST['vilarr']) && empty($_POST['dateDep']) && empty($_POST['hDep']) && empty($_POST['nbPlaces'])) {
    $listeVilleArrive = $villeManager->vilArr($_POST['vildepart']);
    $villeDepart = $villeManager->vilInfo($_POST['vildepart']);
    $_SESSION['vildepart'] = $_POST['vildepart']; ?>
    <form action="#" method="post" id="gridForm">
        <div data-children-count="1">
            <label>Ville de départ :</label>
            <label for=""> <?php echo $villeDepart->getVilNom(); ?></label>

            <label for="vilarr">Ville d'arrive :</label>

            <select id="vilarr" name="vilarr" class="liste">
                <?php foreach ($listeVilleArrive as $ville) { ?>
                    <option value=<?php echo $ville->getVilNum() ?>><?php echo $ville->getVilNom() ?></option>
                <?php } ?>
            </select>
        </div>
        <div data-children-count="2">
            <label for="dateDep">Date de départ : </label>
            <input type="text" id="dateDep" name="dateDep" class="text" value=<?php echo '"' . date("d/m/Y") . '"'; ?>/>

            <label for="hDep">Heure de départ : </label>
            <input type="text" id="hDep" name="hDep" class="text" value=<?php echo '"' . date("H:i:s") . '"'; ?>/>


            <label for="nbPlaces">Nombre de places : </label>

            <input type="number" id="nbPlaces" name="nbPlaces" value="0" min="1" class="text"/>
        </div>
        <input type="submit" value="Valider" class="valider"/>
    </form>
    <?php
} else {


    $parcourManager = new ParcoursManager($pdo);
    $proposeManager = new ProposeManager($pdo);
    $parcoursEtSens = $parcourManager->ParVil1Vil2($_SESSION['vildepart'], $_POST['vilarr']);
    $propose = new Propose(array('par_num' => $parcoursEtSens['parcours'], 'per_num' => $_SESSION['num'], 'pro_date' => getEnglishDate($_POST['dateDep']), 'pro_time' => $_POST['hDep'], 'pro_place' => $_POST['nbPlaces'], 'pro_sens' => $parcoursEtSens['sens']));

    $retour = $proposeManager->add($propose);

    if ($retour != 0) { ?>
        <p><img src="image/valid.png"/> Votre proposition a etait ajoutée</p>
    <?php } else { ?>
        <p><img src="image/erreur.png"/> Erreur</p>
    <?php }
} ?>


