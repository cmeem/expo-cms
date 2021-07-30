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
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        customClass: {
        text: 'text-gray-800 mx-1',
        title: 'text-gray-800 mx-1'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
    document.addEventListener('swal', function(e){
        Toast.fire(e.detail);
    })
    $('#showProfileOffcanvas').click();
});
