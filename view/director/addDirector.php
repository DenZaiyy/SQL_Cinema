<?php
ob_start();

?>

<div class="uk-section uk-section-secondary" style="min-height: 90vh;">
    <div class="uk-container">
        <form enctype="multipart/form-data" action="index.php?action=addDirector" method="post" class="uk-grid-small" uk-grid>
            <legend class="uk-legend">Add new director</legend>
            <div class="uk-margin-small uk-width-1-2">
                <label for="lastname">Lastname:</label>
                <input class="uk-input" type="text" name="lastname" placeholder="Lastname of director" aria-label="Lastname of director" required>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <label for="firstname">Firstname:</label>
                <input class="uk-input" type="text" name="firstname" placeholder="Firstname of director" aria-label="Firstname of director" required>
            </div>
            <div class="uk-margin-small uk-width-1-3">
                <label for="gender">Gender:</label>
                <select name="gender" class="uk-select" required>
                    <option value="default">Choose a gender</option>
                    <option value="H">Men</option>
                    <option value="F">Women</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="uk-margin-small uk-width-1-3">
                <label for="dateOfBirth">Date of birth:</label>
                <input class="uk-input" type="date" name="dateOfBirth" aria-label="Date of birth" required>
            </div>
            <div class="uk-margin-small uk-width-1-3" uk-form-custom="target: true">
                <label for="picture">Image of director:</label>
                <input type="file" class="uk-width-1-1" name="picture" aria-label="Custom controls">
                <input class="uk-input uk-form-width-medium uk-width-1-1" type="text" placeholder="Select file" aria-label="Custom controls" disabled>
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="submit" name="submit" value="Add director" class="uk-button uk-button-default uk-width-1-1">
            </div>
            <div class="uk-margin-small uk-width-1-2">
                <input type="reset" value="Reset values" class="uk-button uk-button-default uk-width-1-1">
            </div>
        </form>
    </div>
</div>




<?php
$title = "Add new director";
$content = ob_get_clean();
require "view/template.php";
