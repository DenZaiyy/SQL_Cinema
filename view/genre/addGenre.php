<?php
ob_start();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form action="index.php?action=addGenre" method="post" class="uk-grid-small" uk-grid>
            <legend class="uk-legend">Add new genre</legend>
            <div class="uk-margin-small uk-width-1-1">
                <input class="uk-input" type="text" name="label" placeholder="Label of genre" aria-label="Label of genre" required>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="submit" name="submit" value="Add genre" class="uk-button uk-button-default uk-width-1-1">
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="reset" value="Reset value" class="uk-button uk-button-default uk-width-1-1">
            </div>
        </form>
    </div>
</div>




<?php
$title = "Add new genre";
$content = ob_get_clean();
require "view/template.php";
