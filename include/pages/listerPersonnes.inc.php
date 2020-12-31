<?php
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$nbr = $personneManager->NombrePersonne();

if (!isset($_POST['per_num'])) {
    ?>
    <div class="sstitre"><h2>Liste des personnes enregistrées</h2></div>

    <div>Actuellement <?php echo $nbr; ?> personnes sont enregistrées</div>
    <br>

    <table>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
        <?php
        foreach ($personnes as $personne) { ?>
            <tr>
                <td>
                    <form method="post">
                        <input id="inputPer" type="submit" name="per_num" value="<?php echo $personne->getPerNum(); ?>">
                    </form>
                </td>
                <td><?php echo $personne->getPerNom(); ?></td>
                <td><?php echo $personne->getPerPre(); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else {
    if ($personneManager->isEtudiant($_POST['per_num'])) {
        $etudiant = $etudiantManager->etuInfo($_POST['per_num']);
        $info = $personneManager->getPersonneNum($_POST['per_num']);
        $dep_num = $etudiant->getDepNum();
        $departementManager = new DepartementManager($pdo);
        $depnom = $departementManager->depInfo($dep_num);
        $villeManager = new VilleManager($pdo);
        $ville_num = $depnom->getVilNum();
        $ville = $villeManager->getVilleParcours($ville_num);
        ?>
        <h1>Détail sur l'étudiant <?php echo $info->getPerNom(); ?></h1>
        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Département</th>
                <th>Ville</th>
            </tr>

            <tr>
                <td><?php echo $info->getPerPre(); ?></td>
                <td><?php echo $info->getPerMail(); ?></td>
                <td><?php echo $info->getPerTel(); ?></td>
                <td><?php echo $depnom->getDepNom(); ?></td>
                <td><?php echo $ville->getVilNom() ?></td>
            </tr>
        </table>
        <?php
    } else {
        $salarie = $salarieManager->SalInfo($_POST['per_num']);
        $info = $personneManager->getPersonneNum($_POST['per_num']);
        $fonctionManager = new FonctionManager($pdo);
        $fon_num = $salarie->getFonNum();
        $fonction = $fonctionManager->fonInfo($fon_num);
        ?>

        <h1>Détail sur le salarié <?php echo $info->getPerNom(); ?></h1>
        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Tel pro</th>
                <th>Fonction</th>
            </tr>
            <tr>
                <td><?php echo $info->getPerPre(); ?></td>
                <td><?php echo $info->getPerMail(); ?></td>
                <td><?php echo $info->getPerTel(); ?></td>
                <td><?php echo $salarie->getSalTelprof(); ?></td>
                <td><?php echo $fonction->getFonLib(); ?></td>
            </tr>
        </table>
        <?php

    }
}
?>