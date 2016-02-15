var FormEditable = function () {

    $.mockjaxSettings.responseTime = 500;

    var log = function (settings, response) {
        var s = [],
            str;
        s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
        for (var a in settings.data) {
            if (settings.data[a] && typeof settings.data[a] === 'object') {
                str = [];
                for (var j in settings.data[a]) {
                    str.push(j + ': "' + settings.data[a][j] + '"');
                }
                str = '{ ' + str.join(', ') + ' }';
            } else {
                str = '"' + settings.data[a] + '"';
            }
            s.push(a + ' = ' + str);
        }
        s.push('RESPONSE: status = ' + response.status);

        if (response.responseText) {
            if ($.isArray(response.responseText)) {
                s.push('[');
                $.each(response.responseText, function (i, v) {
                    s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                });
                s.push(']');
            } else {
                s.push($.trim(response.responseText));
            }
        }
        s.push('--------------------------------------\n');
        $('#console').val(s.join('\n') + $('#console').val());
    }

    var initAjaxMock = function () {
        //ajax mocks

        $.mockjax({
            url: '/post',
            response: function (settings) {
                log(settings, this);
            }
        });
    }


    var initEditables = function () {

        //global settings
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        //editables element samples 
        $('#name').editable({
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'name',
            validate: function (value) {
                if ($.trim(value) == '') return 'Это поле обязательное для заполения';
            }
        });

        $('#desc').editable({
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'desc',
            validate: function (value) {
                if ($.trim(value) == '') return 'Это поле обязательное для заполения';
            }
        });

        $('#what').editable({
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'what',
            validate: function (value) {
                if ($.trim(value) == '') return 'Это поле обязательное для заполения';
            }
        });

        $('#url').editable({
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'url',
            validate: function (value) {
                if ($.trim(value) == '') return 'Это поле обязательное для заполения';
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {

            // inii ajax simulation
            initAjaxMock();

            // init editable elements
            initEditables();

            $('#save').click(function(){
                var self = this;

                $(self).parent().find('button, a').toggle();

                $('#errors').html('');

                var counts = [];
                $('input.count_entity').each(function(){
                    counts.push($(this).val());
                });


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    dataType: 'json',
                    data: {
                        id: $('#product_id').val(),
                        name: $('#name').editable("getValue")['name'],
                        desc: $('#desc').editable("getValue")['desc'],
                        url: $('#url').editable("getValue")['url'],
                        price: $('#price_touchspin').val() * 100,
                        percent: $('#percent_range').val(),
                        entities: $('#entities').val(),
                        counts: counts,
                        count: $('#count_touchspin').val(),
                        level: $('#level').editable("getValue")['level']
                    },
                    url: "/panel/admin/product/update",
                    cache: false,
                    success: function (response) {
                        $(self).parent().find('button, a').toggle();

                        switch (response.status) {
                            case 'success':
                                location.reload();
                                break;
                            case 'error':
                                $.each(response.data, function(index, value) {
                                    $('#errors').append('<div>' + value + '</div>');
                                });
                                break;
                            default:
                                alert(response);
                        }
                    }
                });
            });
        }

    };

}();