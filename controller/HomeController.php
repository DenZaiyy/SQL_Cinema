<?php
require_once 'app/DAO.php';

class HomeController
{
    public function homePage()
    {
        require 'view/home/home.php';
    }
}
