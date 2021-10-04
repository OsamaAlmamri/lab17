$(document).ready(function () {


    $(".show_detail").on("click", function () {
        $("#modal_desc").html($(this).data('description'));
        $("#myDetaols").modal("show");

    });


    $(".custom-file-input").on("change", function () {

        var fileName = $(this).val().split("\\").pop();

        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });

    $("#login").on("click", function () {
        var form = document.getElementById("login_form");
        // var form = $("#login_form");
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $("#login_form").submit();
        }
        form.classList.add('was-validated');
    });

});


(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();




