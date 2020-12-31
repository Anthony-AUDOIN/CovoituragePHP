<?php

class DivisionManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDivision(): array
    {
        $listeDivision = array();

        $sql = 'SELECT * FROM division';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($divisions = $requete->fetch())
            $listeDivision[] = new Division($divisions);

        $requete->closeCursor();
        return $listeDivision;
    }
}