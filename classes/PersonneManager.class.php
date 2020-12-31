<?php

class PersonneManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($personne)
    {
        $requete = $this->db->prepare('INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd) VALUES (:nom, :prenom, :tel, :mail, :login, :pwd);');

        $password = sha1(sha1($personne->getPerPwd()) . SALT);
        $requete->bindValue(':nom', $personne->getPerNom());
        $requete->bindValue(':prenom', $personne->getPerPre());
        $requete->bindValue(':tel', $personne->getPerTel());
        $requete->bindValue(':mail', $personne->getPerMail());
        $requete->bindValue(':login', $personne->getPerLog());
        $requete->bindValue(':pwd', $password);
        return $requete->execute();
    }

    public function getAllPersonne(): array
    {
        $listePersonnes = array();

        $sql = 'SELECT * FROM personne';
        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($personne = $requete->fetch())
            $listePersonnes[] = new Personne($personne);
        $requete->closeCursor();
        return $listePersonnes;
    }

    public function NombrePersonne()
    {

        $sql = 'SELECT count(per_num) as nbr FROM personne';

        $requete = $this->db->prepare($sql);
        $requete->execute();
        return $requete->fetch()['nbr'];

    }

    public function valide($login, $pwd): int
    {
        $motdepassecrypte = sha1(sha1($pwd) . SALT);
        $sql = 'select per_num, per_prenom from personne p where per_login = :login and per_pwd = :pwd';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':login', $login);
        $requete->bindValue(':pwd', $motdepassecrypte);
        $requete->execute();
        if (($personne = $requete->fetch(PDO::FETCH_OBJ))) {
            $requete->closeCursor();
            return 1;
        } else {
            $requete->closeCursor();
            return 0;
        }
    }

    public function perNumSend()
    {
        $sql = 'select MAX(per_num) FROM personne';
        $requete = $this->db->prepare($sql);
        $requete->execute();
        return $requete->fetch();
    }

    public function info($login): Personne
    {
        $sql = 'select per_login, per_num, per_prenom from personne p where per_login = :login';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':login', $login);
        $requete->execute();
        $preparpersonne = $requete->fetch(PDO::FETCH_OBJ);
        return new Personne($preparpersonne);

    }

    public function isEtudiant($per_num): int
    {
        $sql = 'SELECT e.per_num, per_nom, per_prenom from personne p, etudiant e where e.per_num=p.per_num and e.per_num = ' . $per_num;
        $req = $this->db->query($sql);
        if (($personne = $req->fetch(PDO::FETCH_OBJ))) {
            $req->closeCursor();
            return 1;
        } else {
            $req->closeCursor();
            return 0;
        }
    }

    public function getPersonneLogin($login)
    {
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                FROM personne WHERE per_login = :login";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':login', $login);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if (!$ligne) {
            $personne = false;
        } else {
            $personne = new Personne($ligne);
        }

        return $personne;
    }

    public function getPersonneNum($numero)
    {
        $sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd
                FROM personne WHERE per_num = :num";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $numero);
        $requete->execute();
        $ligne = $requete->fetch(PDO::FETCH_ASSOC);
        if (!$ligne) {
            $personne = false;
        } else {
            $personne = new Personne($ligne);
        }
        return $personne;
    }


}