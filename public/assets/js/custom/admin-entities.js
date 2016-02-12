jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    TableEntities.init();

    $('body').on("click", '.b-load', function (e) {
        $('.modal-dialog').html(
            '<div class="modal-content">' +
                '<div class="modal-body">' +
                    '<img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">' +
                    '<span>&nbsp;&nbsp;' + messages['loading'] + '... </span>' +
                '</div>' +
            '</div>');
    });

    $('body').on("click", '.thumbnail .glyphicon-remove', function (e) {
        if (confirm('Вы действительно желаете удалить данное изображение?')) {
            var self = this;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '/panel/admin/entity/' + $(self).attr('data-id') + '/delete-image',
                cache: false,
                success: function (response) {
                    if(response) {
                        $(self).parent().remove();
                    }
                }
            });
        }
    });
});
