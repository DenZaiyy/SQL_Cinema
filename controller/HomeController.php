<?php
require_once 'app/DAO.php';

class HomeController
{
    // function permettant d'afficher les 5 films les plus récents ainsi que les 5 films les mieux notés
    public function homePage()
    {
        $dao = new DAO();

        $sql = "SELECT id_film, title, DATE_FORMAT(date_release, '%Y') dateRealease, TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duration, note, picture 
        FROM film
        ORDER BY date_release DESC
        LIMIT 5";

        $sql2 = "SELECT id_film, title, DATE_FORMAT(date_release, '%Y') dateRealease, TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duration, note, picture
        FROM film
        ORDER BY note DESC
        LIMIT 5";

        $films = $dao->executeRequest($sql);
        $notes = $dao->executeRequest($sql2);
        require 'view/home/home.php';
    }
}
