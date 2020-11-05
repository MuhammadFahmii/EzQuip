$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// sidebar
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});
