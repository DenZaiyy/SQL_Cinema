<?php
ob_start() //def :
?>

<h1>Ceci est ma homePage</h1>













<?php
$title = "Home Page";
$content = ob_get_clean(); //def 
require "view/template.php";
