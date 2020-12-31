<?php

class EtudiantManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($etudiant)
    {
        $requete = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num) VALUES (:per_num, :dep_num, :div_num);');

        $requete->bindValue(':per_num', $etudiant->getPerNum());
        $requete->bindValue(':dep_num', $etudiant->getDepNum());
        $requete->bindValue(':div_num', $etudiant->getDivNum());
        return $requete->execute();
    }

    public function etuInfo($per_num): Etudiant
    {
        $sql = 'SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num =' . $per_num;
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $etuInfos = $requete->fetch(PDO::FETCH_OBJ);
        $etudiant = new Etudiant($etuInfos);
        $requete->closeCursor();
        return $etudiant;
    }

}