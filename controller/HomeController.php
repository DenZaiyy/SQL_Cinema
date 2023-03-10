<?php
require_once 'app/DAO.php';

class HomeController
{
    public function homePage()
    {
        $dao = new DAO();

        $sql = "SELECT id_film, title, DATE_FORMAT(date_release, '%Y') dateRealease, TIME_FORMAT(SEC_TO_TIME(duration*60),'%H:%i') duration, picture 
        FROM film
        ORDER BY date_release DESC
        LIMIT 3";

        $films = $dao->executeRequest($sql);
        require 'view/home/home.php';
    }
}
