<?php
// will always be this, so copy/paste and modify the bdname to actual bdd
//opens access to BDD - bddname to be determined in mysql link
// equivalent to CONNECT::
class DAO
//Data Access Object :
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');
    }

    function getBDD()
    {
        return $this->bdd;
    }

    public function executeRequest($sql, $params = NULL)
    {
        // if parameters are null-> do the query
        if ($params == NULL) {
            $resultat = $this->bdd->query($sql);
        } else {
            // prepare query -> protects against SQL attacks
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;
    }
}
