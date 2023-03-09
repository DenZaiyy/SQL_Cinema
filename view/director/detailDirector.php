<?php
ob_start(); //def :
$director = $directors->fetch();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">

        <div class="uk-flex uk-flex-between">


            <div class="uk-width-auto">
                <figure>
                    <img src="<?= $director["picture"] ?>" alt="picture of <?= $director["firstname"] . ' ' .  $director["lastname"] ?>" style="height: auto; width: 300px;">
                </figure>
            </div>

            <div class="uk-width-auto">
                <h1>Details of <strong><?= $director["firstname"] . ' ' .  $director["lastname"] ?></strong></h1>

                <p class="uk-margin">We have a filmographie of <strong><?= $director["firstname"] . ' ' .  $director["lastname"] ?></strong></p>

                <table class="uk-table uk-table-striped uk-text-center">
                    <thead>
                        <tr>
                            <th>Title of film</th>
                            <th>Date of parruption</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cast->fetchAll() as $casting) { ?>
                            <tr>
                                <td><?= $casting['title']; ?></td>
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
