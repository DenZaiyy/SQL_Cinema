<?php
ob_start();
// require_once "controller/DirectorController.php";

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form action="index.php?action=addFilm" method="$_POST">

        </form>
    </div>
</div>




<?php
$title = "Add new film";
$content = ob_get_clean();
require "view/template.php";
