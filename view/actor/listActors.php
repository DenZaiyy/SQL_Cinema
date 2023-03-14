<?php
ob_start(); //def :
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">

        <h1>Lists of actors <span class="uk-badge"><?= $actors->rowCount() ?></span></h1>

        <div class="uk-grid-match uk-grid-small uk-flex-center" uk-grid>

            <?php
            while ($actor = $actors->fetch()) { ?>

                <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                    <div class="uk-card uk-card-small uk-card-default uk-height-match">
                        <figure class="uk-padding-small uk-height-match">
                            <a href="index.php?action=detailActor&id=<?= $actor['id_actor'] ?>">
                                <img src="<?= $actor["picture"] ?>" alt="picture of <?= strtoupper($actor["lastname"]) . ' ' . $actor["firstname"]  ?>" width="250">
                            </a>
                            <figcaption>
                                <p class="uk-text-center uk-margin-small-top"><?= strtoupper($actor["lastname"]) . ' ' . $actor["firstname"] ?></p>
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
