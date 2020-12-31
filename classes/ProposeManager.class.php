<?php

class ProposeManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($propose)
    {
        $requete = $this->db->prepare('INSERT INTO propose(per_num, par_num, pro_date, pro_time, pro_place, pro_sens) VALUES (:per_num, :par_num, :pro_date, :pro_time, :pro_place, :pro_sens)');

        $requete->bindValue(':per_num', $propose->getPerNum());
        $requete->bindValue(':par_num', $propose->getParNum());
        $requete->bindValue(':pro_date', $propose->getProDate());
        $requete->bindValue(':pro_time', $propose->getProTime());
        $requete->bindValue(':pro_place', $propose->getProPlace());
        $requete->bindValue(':pro_sens', $propose->getProSens());
        return $requete->execute();
    }

    public function villeEnDepart(): array
    {
        $listeVille = array();
        $sql = 'select distinct vil_num, vil_nom 
                        from ville 
                        where vil_num IN (select vil_num1 
                            from parcours p inner join propose pr on pr.par_num = p.par_num 
                            where pro_sens = 0) 
                        OR vil_num IN (select vil_num2 
                            from parcours p inner join propose pr on pr.par_num = p.par_num 
                            where pro_sens = 1)';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeVille[] = new Ville($ligne);
        }

        $requete->closeCursor();
        return $listeVille;
    }

    /**
     * @param $par_num
     * @param $date
     * @param $precision
     * @param $heure
     * @param $sens
     * @return Propose[]
     */
    public function trajetAccepte($par_num, $date, $precision, $heure, $sens): array
    {
        $listeTrajet = array();
        $sql = "SELECT * from propose 
                        Where par_num = :par_num 
                        AND pro_date BETWEEN date_add(:date, INTERVAL :precision1 DAY) AND date_add(:date, INTERVAL :precision DAY) 
                        AND pro_time >= :pro_time 
                        AND pro_sens = :pro_sens";

        $requete = $this->db->prepare($sql);
        $requete->bindValue(":par_num", $par_num);
        $requete->bindValue(":date", $date);
        $requete->bindValue(":precision", $precision);
        $requete->bindValue(":precision1", -$precision);
        $requete->bindValue(":pro_time", $heure);
        $requete->bindValue(":pro_sens", $sens);
        $requete->execute();

        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $listeTrajet[] = new Propose($ligne);
        }
        $requete->closeCursor();
        return $listeTrajet;
    }
}