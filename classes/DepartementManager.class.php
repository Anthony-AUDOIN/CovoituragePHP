<?php

class DepartementManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDepartement(): array
    {
        $listeDepartements = array();

        $sql = 'SELECT dep_num, dep_nom, vil_num FROM departement';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($departement = $requete->fetch(PDO::FETCH_OBJ))
            $listeDepartements[] = new Departement($departement);
        $requete->closeCursor();
        return $listeDepartements;
    }

    public function depInfo($dep_num): Departement
    {
        $sql = 'SELECT dep_num, dep_nom, vil_num FROM departement WHERE dep_num =' . $dep_num;
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $depInfos = $requete->fetch(PDO::FETCH_OBJ);
        $departement = new Departement($depInfos);
        $requete->closeCursor();
        return $departement;
    }
}