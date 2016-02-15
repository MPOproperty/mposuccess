jQuery(document).ready(function() {
    var urlToAjax =  "/panel/admin/withdrawal";

    Metronic.init(); // init metronic core components
    TableWithdrawal.init(urlToAjax);

    $('body').on("click", '.b-load', function (e) {
        $('.modal-dialog').html(
            '<div class="modal-content">' +
                '<div class="modal-body">' +
                    '<img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">' +
                '</div>' +
            '</div>');
    });
});
