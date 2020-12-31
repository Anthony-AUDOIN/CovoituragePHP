<?php

class FonctionManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllFonction(): array
    {
        $listeFonctions = array();

        $sql = 'SELECT * FROM fonction';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($fonction = $requete->fetch(PDO::FETCH_OBJ))
            $listeFonctions[] = new Fonction($fonction);
        $requete->closeCursor();
        return $listeFonctions;
    }

    public function fonInfo($fon_num): Fonction
    {
        $sql = 'SELECT fon_num, fon_libelle FROM fonction WHERE fon_num =' . $fon_num;
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $fonInfos = $requete->fetch(PDO::FETCH_OBJ);
        $fonction = new Fonction($fonInfos);
        $requete->closeCursor();
        return $fonction;
    }

}