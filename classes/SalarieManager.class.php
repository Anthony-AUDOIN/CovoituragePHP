<?php

class SalarieManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($salarie)
    {
        $requete = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num) VALUES (:num, :telprof, :fon_num);');

        $requete->bindValue(':num', $salarie->getPerNum());
        $requete->bindValue(':telprof', $salarie->getSalTelprof());
        $requete->bindValue(':fon_num', $salarie->getFonNum());
        return $requete->execute();
    }


    public function salInfo($per_num): Salarie
    {
        $sql = 'SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num =' . $per_num;
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $salInfos = $requete->fetch(PDO::FETCH_OBJ);
        $salarie = new Salarie($salInfos);
        $requete->closeCursor();
        return $salarie;
    }


}