<?php
ob_start(); //def :
$actor = $actors->fetch();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">

        <div class="uk-flex uk-flex-between">


            <div class="uk-width-auto">
                <figure>
                    <img src="<?= $actor["picture"] ?>" alt="picture of <?= $actor["firstname"] . ' ' .  $actor["lastname"] ?>" style="height: auto; max-width: 300px;">
                </figure>
            </div>

            <div class="uk-width-auto">
                <h1>Details of <strong><?= $actor["firstname"] . ' ' .  $actor["lastname"] ?></strong></h1>

                <p class="uk-margin">We have a filmographie of <strong><?= $actor["firstname"] . ' ' .  $actor["lastname"] ?></strong></p>

                <table class="uk-table uk-table-striped uk-text-center">
                    <thead>
                        <tr>
                            <th>Title of film</th>
                            <th>Role</th>
                            <th>Date of parruption</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cast->fetchAll() as $casting) { ?>
                            <tr>
                                <td><?= $casting['title']; ?></td>
                                <td><?= $casting['label']; ?></td>
                                <td><?= $casting['Year']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php
$title = "Detail of";
$content = ob_get_clean(); //def 
require "view/template.php";
