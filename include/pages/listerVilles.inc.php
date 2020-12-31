<?php
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
$nbr = $villeManager->NombreVille();

?>
<div class="sstitre"><h2>Liste des villes</h2></div>

<div>Actuellement <?php echo $nbr; ?> villes sont enregistrées</div>
<br>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
    </tr>
    <?php
    foreach ($villes as $ville) { ?>
        <tr>
            <td><?php echo $ville->getVilNum(); ?>
            </td>
            <td><?php echo $ville->getVilNom(); ?>
            </td>
        </tr>
    <?php } ?>
</table>
<br/>
