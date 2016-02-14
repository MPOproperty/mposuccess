/**
 * Created by NotPrometey on 20.09.2015.
 */
$(function(){
   $('.add2cart').click(function(e){
       e.preventDefault();

       var balance = parseFloat($('#header_balance_show').text());
       var count = $(this).prev().hasClass('pi-price') ? 1 : $('.product-quantity .form-control').val();
       var price = parseFloat($(this).parent().parent().find('.pi-price, .price').text());

       if (count*price > balance ) {
           bootbox.dialog({
               message: "У вас недостаточно средств для покупки данного продукта!",
               title: "Внимание!",
               buttons: {
                   main: {
                       label: "Закрыть",
                       className: "btn-default"
                   }
               }
           });
       } else {
           var self = this;

           bootbox.confirm({
               title: 'Внимание!',
               message: 'Вы действительно желаете купить данный продукт?',
               buttons: {
                   'confirm': {
                       label: 'Да',
                       className: 'btn-danger pull-right'
                   },
                   'cancel': {
                       label: 'Нет',
                       className: 'btn-default pull-right'
                   }
               },
               callback: function(result) {
                   if (result) {
                       var bye = $.ajax({
                           url: $(self).attr('href') + '/' + count,
                           headers: {
                               'X-CSRF-Token' : $('meta[name=_token]').attr('content')
                           },
                           method: "POST",
                           dataType: "json"
                       });

                       bye.done(function( response ) {
                           console.log(response);
                           $('.fancybox-close').click();
                           $.each(response, function(index, res){
                               toastr[res.type](res.message, res.name);
                           });

                           $.ajax({
                               url: '/panel/balance',
                               headers: {
                                   'X-CSRF-Token': $('meta[name=_token]').attr('content')
                               },
                               method: "GET"
                           }).done(function (response) {
                               $("#header_balance_show").text(response);
                           });
                       });

                       bye.fail(function( jqXHR, textStatus ) {
                           toastr['error']("Request failed: " + textStatus, 'Error!');
                       });
                   }
               }
           });
       }
   });

    function initImageZoom() {
        $('.product-main-image > img.zoomImg').remove();
        $('.product-main-image').zoom({url: $('.product-main-image img').attr('src')});
    }

    function initTouchspin() {
        $(".product-quantity .form-control").TouchSpin({
            buttondown_class: "btn quantity-down",
            buttonup_class: "btn quantity-up",
            min: 1,
            max: 6
        }).on('touchspin.on.startspin, touchspin.on.stopspin', function () {
            var count = $(this).val();
            var price =  $('.price strong').text();

            if (count > 1)
                $('#total').show('100').find('strong')
                    .html("<i class='fa fa-rouble'></i>" + (price*count).toFixed(2));
            /*else
                $('#total').hide('100');*/
        });

        $(".quantity-down").html("<i class='fa fa-angle-down'></i>");
        $(".quantity-up").html("<i class='fa fa-angle-up'></i>");
    }

    function initFancybox() {
        if (!jQuery.fancybox)
            return;

        jQuery(".fancybox-fast-view").fancybox();
    }

    initImageZoom();
    initTouchspin();
    initFancybox();

    $(document.body).on('click', '.product-other-images a img', function () {
        $(this).closest('div').find('a').removeClass('active');
        $(this).parent().addClass('active');
        $('.product-main-image > img').attr('src', $(this).attr('src'));

        initImageZoom();
    });

    $('.fancybox-fast-view').click(function() {
        var elem = $('#product-pop-up');

        elem.find('.product-other-images').html('');
        elem.find('.product-main-image > img').attr('src', '');

        var images = ($(this).attr('data-images')).split(",");
        for(var i=0; i < images.length; i++ ) {
            if (images[i] != '') {
                if (i) {
                    elem.find('.product-other-images').append('<a href="javascript:;"><img alt="" src="' + storage_img_entities + images[i] + '"></a>');
                } else {
                    elem.find('.product-other-images').append('<a href="javascript:;" class="active"><img alt="" src="' + storage_img_entities + images[i] + '"></a>');
                }
            }
        }

        elem.find('.product-main-image > img').attr('src', $(this).prev().attr('href'));
        elem.find('h1').text($(this).parent().parent().next().text());
        elem.find('.price strong').html($(this).parent().parent().next().next().html());
        elem.find('.availability strong').html($(this).attr('data-count'));
        if ($(this).attr('data-count') == 0) {
            elem.find('.availability').hide();
            $(".product-quantity").show();
            $('#total').show('100');
        } else {
            elem.find('.availability').show();
            $(".product-quantity").hide();
            $('#total').hide('100');
        }
        elem.find('.description p').html($(this).attr('data-desc'));
        elem.find('.add2cart').attr('href', $(this).parent().parent().next().next().next().attr('href'));

        var count = $('.product-quantity .form-control').val();
        var price = $('.price strong').text();
        $('#total strong')
            .html("<i class='fa fa-rouble'></i>" + (price*count).toFixed(2));

        /*elem.find('.sticker').remove();
        if ($(this).attr('data-tag'))*/
            elem.find('div.row .sticker > span').html($(this).closest('.product-item').find('.sticker > span').text());
//alert('sss ' + $(this).closest('.product-item').find('.sticker > span').text());
        initImageZoom();
    });
});