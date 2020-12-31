<?php
$pdo = new Mypdo();
$parcoursManager = new ParcoursManager($pdo);
$villeManager = new VilleManager($pdo);
$parcours = $parcoursManager->getAllParcours();
$nbr = $parcoursManager->NombreParcours();

?>
<div class="sstitre"><h2>Liste des Parcours</h2></div>

<div>Actuellement <?php echo $nbr; ?> parcours sont enregistrées</div>
<br>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom ville</th>
        <th>Nom ville</th>
        <th>Nombre de Km</th>
    </tr>
    <?php
    foreach ($parcours as $parcour) { ?>
        <tr>
            <td><?php echo $parcour->getParNum(); ?> </td>
            <td><?php echo $villeManager->getVilleParcours($parcour->getVilNum1())->getVilNom(); ?></td>
            <td><?php echo $villeManager->getVilleParcours($parcour->getVilNum2())->getVilNom(); ?></td>
            <td><?php echo $parcour->getParKm(); ?></td>
        </tr>
    <?php } ?>
</table>
<br/>