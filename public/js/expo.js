$(document).ready(function () {
    $("#sidebar-toggle").on("click", function () {
        $("#main-sidebar").toggleClass("show-side");
        $("body").toggleClass("body-pd");
        $(this).toggleClass("rotate");
    });
    $("#main-sidebar").hover(
        function () {
            $(this).addClass("show-side");
            $("body").addClass("body-pxd");
        },
        function () {
            if (!$("body").hasClass("body-pd")) {
                $(this).removeClass("show-side");
            }

        }
    );
    var myOffcanvas = document.getElementById("SearchOffcanvas");
    myOffcanvas.addEventListener("shown.bs.offcanvas", function () {
        $("#offcanvanSearch").focus();
    });
    var myOffcanvas = document.getElementById("SearchOffcanvas");
    myOffcanvas.addEventListener("hidden.bs.offcanvas", function () {
        $("#offcanvanSearch").val(null);
    });
});
