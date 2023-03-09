<?php
ob_start(); //def :
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">

        <h1>Lists of actors (<?= $actors->rowCount() ?>)</h1>

        <div class="uk-grid-small" uk-grid>


            <?php
            while ($actor = $actors->fetch()) { ?>

                <div class="uk-width-auto@m uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                    <div class="uk-card uk-card-default uk-height-match">
                        <figure class="uk-padding uk-height-match">
                            <a href="index.php?action=detailActor&id=<?= $actor['id_actor'] ?>">
                                <img src="<?= $actor["picture"] ?>" alt="picture of <?= $actor["firstname"] . ' ' .  $actor["lastname"] ?>" width="250px">
                            </a>
                            <figcaption>
                                <p><?= $actor["firstname"] . ' ' .  $actor["lastname"] ?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            <?php }
            ?>

        </div>
    </div>




    <?php
    $title = "List of Actors";
    $content = ob_get_clean(); //def 
    require "view/template.php";
