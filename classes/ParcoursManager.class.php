<?php

class ParcoursManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($parcours)
    {
        $requete = $this->db->prepare('INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES (:km, :num1, :num2);');

        $requete->bindValue(':km', $parcours->getParKm());
        $requete->bindValue(':num1', $parcours->getVilNum1());
        $requete->bindValue(':num2', $parcours->getVilNum2());

        return $requete->execute();
    }

    public function getVille1(): array
    {
        $listeVille1 = array();

        $sql = 'SELECT DISTINCT vil_nom FROM ville v JOIN parcours p  ON v.vil_num=p.vil_num1  ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while ($ville1 = $requete->fetch())
            $listeVille1[] = new Parcours($ville1);

        $requete->closeCursor();
        return $listeVille1;
    }

    public function getVille2(): array
    {
        $listeVille2 = array();

        $sql = 'SELECT DISTINCT par_num, vil_nom FROM ville v JOIN parcours p  ON v.vil_num=p.vil_num2  ';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while ($ville1 = $requete->fetch())
            $listeVille2[] = new Parcours($ville1);

        $requete->closeCursor();
        return $listeVille2;
    }

    public function getAllParcours(): array
    {
        $listeParcours = array();

        $sql = 'SELECT par_num, par_km, vil_num1, vil_num2  FROM parcours';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($parcours = $requete->fetch())
            $listeParcours[] = new Parcours($parcours);

        $requete->closeCursor();
        return $listeParcours;
    }

    public function NombreParcours()
    {

        $sql = 'SELECT count(par_num) as nbr FROM parcours';

        $requete = $this->db->prepare($sql);
        $requete->execute();
        return $requete->fetch()['nbr'];

    }

    public function ParVil1Vil2($vil_num1, $vil_num2)
    {
        $tabParcours = array();
        $sql = 'SELECT par_num FROM parcours WHERE vil_num1 = :vil_num1 AND vil_num2 = :vil_num2';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':vil_num1', $vil_num1);
        $requete->bindValue(':vil_num2', $vil_num2);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if (!$ligne) {
            $sql = 'SELECT par_num FROM parcours WHERE vil_num1 = :vil_num2 AND vil_num2 = :vil_num1';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':vil_num1', $vil_num1);
            $requete->bindValue(':vil_num2', $vil_num2);
            $requete->execute();
            $ligne = $requete->fetch(PDO::FETCH_ASSOC);
            if (!$ligne) {
                $tabParcours = false;
            } else {
                $tabParcours['sens'] = 1;
                $tabParcours['parcours'] = $ligne['par_num'];
            }
        } else {
            $tabParcours['sens'] = 0;
            $tabParcours['parcours'] = $ligne['par_num'];
        }
        return $tabParcours;
    }

}
