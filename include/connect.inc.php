<?php
  $db = mysqli_connect ("localhost", "bd", "bede") or die ("Connexion à MySQL impossible");
  mysqli_select_db($db, "COVOITURAGE") or die ("Impossible de se connecter à la base de donnée");

