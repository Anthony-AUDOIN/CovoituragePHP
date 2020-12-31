<?php

class VilleManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($ville)
    {
        $requete = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES (:nom);');

        $requete->bindValue(':nom', $ville->getVilNom());
        return $requete->execute();
    }

    public function getAllVille(): array
    {
        $listeVilles = array();

        $sql = 'SELECT * FROM ville';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($ville = $requete->fetch())
            $listeVilles[] = new Ville($ville);

        $requete->closeCursor();
        return $listeVilles;
    }


    public function NombreVille()
    {

        $sql = 'SELECT count(vil_num) as nbr FROM ville';

        $requete = $this->db->prepare($sql);
        $requete->execute();
        return $requete->fetch()['nbr'];

    }

    public function rechercheVilArr($vil_num): array
    {
        $listeVille = array();
        $sql = 'Select distinct vil_num, vil_nom from ville 
                                where vil_num in (select vil_num1 from parcours where vil_num2=:num) 
                                OR vil_num in (select vil_num2 from parcours where vil_num1=:num)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $vil_num);
        $requete->execute();
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $ville = new Ville($ligne);
            $listeVille[] = $ville;
        }

        $requete->closeCursor();
        return $listeVille;
    }

    public function getVilleParcours($id): Ville
    {
        $sql = "SELECT vil_nom FROM ville WHERE vil_num ='$id' ";

        $requete = $this->db->prepare($sql);
        $requete->execute();
        $ville = $requete->fetch();
        return new Ville($ville);
    }

    public function NumToNomVil($num)
    {
        $sql = "SELECT vil_nom FROM ville WHERE vil_num = :num";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);
        $requete->execute();

        return $requete->fetch();
    }

    public function vilInfo($vil_num)
    {
        $sql = 'SELECT vil_num, vil_nom FROM ville WHERE vil_num =' . $vil_num;
        $requete = $this->db->prepare($sql);
        $requete->execute();
        $vilInfos = $requete->fetch(PDO::FETCH_OBJ);
        $ville = new Ville($vilInfos);
        $requete->closeCursor();
        return $ville;
    }

    public function vilDep(): array
    {
        $listeVille = array();
        $sql = 'Select distinct vil_num, vil_nom from ville 
                                where vil_num in (select vil_num1 from parcours) 
                                OR vil_num in (select vil_num2 from parcours)';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $ville = new Ville($ligne);
            $listeVille[] = $ville;
        }

        $requete->closeCursor();
        return $listeVille;
    }

    public function vilArr($vil_num): array
    {
        $listeVille = array();
        $sql = 'SELECT DISTINCT vil_num, vil_nom from ville 
                                where vil_num in (select vil_num1 from parcours where vil_num2=:num) 
                                OR vil_num in (select vil_num2 from parcours where vil_num1=:num)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $vil_num);
        $requete->execute();
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)) {
            $ville = new Ville($ligne);
            $listeVille[] = $ville;
        }

        $requete->closeCursor();
        return $listeVille;
    }
}
