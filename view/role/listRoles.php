<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<div class="uk-section uk-section-secondary">
    <div class="uk-container">
        <h1>Lists of roles <span class="uk-badge"><?= $roles->rowCount() ?></span></h1>

        <div class="uk-grid-match uk-grid-small" uk-grid>
            <?php
            while ($role = $roles->fetch()) { ?>

                <a href="index.php?action=detailRole&id=<?= $role['id_role'] ?>">
                    <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                        <div class="uk-card uk-card-small uk-card-default uk-height-match uk-padding-small">
                            <strong class=""><?= $role['label'] ?></strong>
                        </div>
                    </div>
                </a>

            <?php }
            ?>
        </div>

    </div>
</div>







<?php
$title = "List of Genres";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
