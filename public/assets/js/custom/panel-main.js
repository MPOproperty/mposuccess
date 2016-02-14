var isActive = true;

window.onblur = function () { isActive = false };
window.onfocus = function () { isActive = true };

//jQuery(document).ready(function() {
(function($){
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "20000",
        "extendedTimeOut": "10000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(document).ajaxStart(
        function(event, jqxhr, settings){
            Metronic.blockUI({
                target: 'body',
                animate: true
            });
        }
    ).ajaxStop(
        function(event, jqxhr, settings) {
            Metronic.unblockUI('body');
        }
    );

    loadNotification();


    function loadNotification(){
        var notification = $.ajax({
            url: '/panel/notification/' + notification_count,
            /*headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },*/
            method: "POST",
            dataType: "json",
            global: false
        });

        notification.done(function( response ) {
            console.log(response);
            d = new Date();
            date = d.getDate();
            month = d.getMonth() + 1;
            year = d.getFullYear();
            $.each(response, function(index, res){
                if('notification_count' == res.type){
                    notification_count = res.count;
                    $('#notification-count').text(notification_count);
                    if (notification_count > 0)
                        $('#markAllNotification, #notification-count').show();
                } else {
                    if(isActive) {
                        toastr[res.type](res.message, res.name);
                        $('#notification-list').prepend(/*append(*/
                            '<li class="new" data-id="' + res.id + '">' +
                            '<a href="javascript:;">' +
                            '<span class="time">' +
                            date + "/" + month + "/" + year +
                            '</span>' +
                            '<span class="details"> ' +
                            '<span class="label label-sm label-icon label-success">' +
                            '<i>' + res.name + '</i>' +
                            '</span>' +
                            '</span>' +
                            '<div>' +
                            res.message +
                            '</div>' +
                            '</a>' +
                            '</li>'
                        );
                    }
                }
            });
            setTimeout(loadNotification, 5000);
        });

        notification.fail(function( jqXHR, textStatus ) {
            setTimeout(loadNotification, 5000);
        });
    }

    $(document.body).on('click', '#notification-list li', function () {
        if(!$(this).hasClass('new'))
            return false;

        $(this).append('<div class="loading"><img src="/assets/img/loading-spinner-grey.gif"><div>');

        var self = this;

        $.ajax({
            /*headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },*/
            type: "post",
            url: '/panel/notification/' + $(this).attr('data-id') + '/mark',
            cache: false,
            global: false,
            success: function (response) {
                $(self).find('.loading').remove();
                if (response)
                    $(self).removeClass('new');
                    notification_count -= 1;
                    $('#notification-count').text(notification_count);
                    if (notification_count == 0)
                        $('#markAllNotification, #notification-count').hide();
            }
        });

        return false;
    });

    $('#markAllNotification').click(function(){
        $.ajax({
            /*headers: {
                'X-CSRF-Token' : $('meta[name=_token]').attr('content')
            },*/
            type: "post",
            url: '/panel/notification/markAll',
            cache: false,
            success: function (response) {
                if (response)
                    $('#notification-list li').removeClass('new');
                notification_count = 0;
                $('#notification-count').text(notification_count);
                $('#markAllNotification, #notification-count').hide();
            }
        });
    });

    //Hide the overview when click
    $('#someid').on('click', function () {
        $('#OverviewcollapseButton').removeClass("collapse").addClass("expand");
        $('#PaymentOverview').hide();
    });

    $(window).load(function() {
        $('a.not-active').removeClass('not-active');
    });

    $('.tooltips').tooltip();
})(jQuery);