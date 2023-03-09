<?php
ob_start(); //def :
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of films</h1>
        <p>We order this list by the most recent date</p>

        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
            <?php
            while ($film = $films->fetch()) { ?>

                <figure>
                    <img src="<?= $film["picture"] ?>" alt="picture of <?= $film["title"] ?>" style="height: auto; max-width: 310px;">
                    <figcaption>
                        <p><?= $film["title"] . " - duration: " . $film["duration"] . ' - date of release: ' .  $film["dateRealease"] ?></p>
                    </figcaption>
                </figure>

            <?php }
            ?>
        </div>

    </div>
    <aside>

    </aside>
</div>





<?php
$title = "Home Page";
$content = ob_get_clean(); //def 
require "view/template.php";
