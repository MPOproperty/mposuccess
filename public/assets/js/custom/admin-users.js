jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    TableUsers.init();

    $('body').on("click", '.b-load', function (e) {
        $('.modal-dialog').html(
            '<div class="modal-content">' +
                '<div class="modal-body">' +
                    '<img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">' +
                    '<span>&nbsp;&nbsp;' + messages['loading'] + '... </span>' +
                '</div>' +
            '</div>');
    });
});
