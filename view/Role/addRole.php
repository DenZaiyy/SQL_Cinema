<?php
ob_start();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form action="index.php?action=addRole" method="post" class="uk-grid-small" uk-grid>
            <legend class="uk-legend">Add new role</legend>
            <div class="uk-margin-small uk-width-1-1">
                <input class="uk-input" type="text" name="label" placeholder="Label of role" aria-label="Label of role" required>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="submit" name="submit" value="Add role" class="uk-button uk-button-default uk-width-1-1">
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="reset" value="Reset value" class="uk-button uk-button-default uk-width-1-1">
            </div>
        </form>
    </div>
</div>




<?php
$title = "Add new role";
$content = ob_get_clean();
require "view/template.php";
