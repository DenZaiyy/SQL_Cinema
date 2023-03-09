<?php
ob_start() //def :
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">

        <h1>Lists of actors</h1>
        <p>Il y as <?= $actors->rowCount() ?> acteurs</p>

        <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>

            <?php
            while ($actor = $actors->fetch()) { ?>

                <figure>
                    <img src="<?= $actor["picture"] ?>" alt="picture of <?= $actor["firstname"] . ' ' .  $actor["lastname"] ?>" style="height: auto; max-width: 200px;">
                    <figcaption>
                        <p><?= $actor["id_actor"] . " - " . $actor["firstname"] . ' ' .  $actor["lastname"] ?></p>
                    </figcaption>
                </figure>

            <?php }
            ?>

        </div>

    </div>
</div>













<?php
$title = "List of Actors";
$content = ob_get_clean(); //def 
require "view/template.php";
