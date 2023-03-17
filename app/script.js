$(document).ready(function () {
    function fetchData() {
        var s = $("#input").val();

        if (s == "") {
            $("#dropdown").css("display", "none");
        }

        $.post(
            "index.php?action=searchFilm",
            {
                s: s,
            },
            function (data, status) {
                if (data != "not found") {
                    $("#dropdown").css("display", "block");
                    $("#dropdown").html(data);
                }
            }
        );
    }

    $("body").on("click", () => {
        $("#dropdown").css("display", "none");
    });

    $("#input").on("input", fetchData);
});
