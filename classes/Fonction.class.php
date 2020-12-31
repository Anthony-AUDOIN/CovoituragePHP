<?php

class Fonction
{
    private $fon_num;
    private $fon_libelle;

    public function __construct($valeurs = array())
    {
        if (!empty($valeurs))
            $this->affecte($valeurs);
    }

    public function affecte($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'fon_num' :
                    $this->setFonNum($valeur);
                    break;
                case 'fon_libelle':
                    $this->setFonLib($valeur);
                    break;
            }
        }
    }

    public function setFonLib($fon_libelle)
    {
        return $this->fon_libelle = $fon_libelle;
    }

    public function getFonNum()
    {
        return $this->fon_num;
    }

    public function setFonNum($fon_num)
    {
        return $this->fon_num = $fon_num;
    }

    public function getFonLib()
    {
        return $this->fon_libelle;
    }
}