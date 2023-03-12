<?php
// will always be this, so copy/paste and modify the bdname to actual bdd
//opens access to BDD - bddname to be determined in mysql link
// equivalent to CONNECT::
class DAO
// DAO = Data Access Object : un patron de conception (c'est-à-dire un modèle pour concevoir une solution) utilisé dans les architectures logicielles objet.
{
    private $bdd;

    public function __construct()
    {
        $db_host = "db";
        $db_name = "cinema";
        $db_user = "root";
        $db_pass = "test123";

        // $this->bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');
        $this->bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
    }

    function getBDD()
    {
        return $this->bdd;
    }

    //Function pour vérifier le type de requete à exécuter, si aucun params alors la requete executera un query, sinon un prepare puis execute
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
