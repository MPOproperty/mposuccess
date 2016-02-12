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
            title: 'Enter username',
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            }
        });

        $('#status').editable({
            inputclass: 'form-control',
            source: [{
                value: 1,
                text: messages['statusDisplayed']
            }, {
                value: 0,
                text: messages['statusHidden']
            }
            ],
            display: function (value, sourceData) {
                var colors = {
                        "": "gray",
                        1: "green",
                        0: "red"
                    },
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            }
        });

        $('#type').editable({
            inputclass: 'form-control',
            source: [{
                value: messages['typePrivateValue'],
                text:  messages['typePrivate']
            }, {
                value: messages['typeCompanyValue'],
                text:  messages['typeCompany']
            }, {
                value: messages['typeWorldValue'],
                text:  messages['typeWorld']
            }
            ],
            display: function (value, sourceData) {
                var colors = {
                        "": "gray",
                        1: "red",
                        2: "green",
                        3: "blue"
                    },
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            }
        });


        $('#content').editable({
            showbuttons : (Metronic.isRTL() ? 'left' : 'right'),
            wysihtml5: {
                locale: 'ru-RU'
            }
        });

        $('#contentEdit').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#content').editable('toggle');
        });

        $('#preview').editable({
            showbuttons : (Metronic.isRTL() ? 'left' : 'right'),
            wysihtml5: {
                locale: 'ru-RU'
            }
        });

        $('#previewEdit').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#preview').editable('toggle');
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

                var form = $('form#file-ajax');

                form.find('input[name="name"]').val($('#name').editable("getValue")['name']);
                form.find('input[name="content"]').val($('#content').editable("getValue")['content']);

                var textPreview = $('#preview').editable("getValue")['preview'];
                if(!textPreview) {
                    var textContent = $('#content').editable("getValue")['content'];
                    textPreview = textContent.slice(0,100);
                    if (textPreview.length < textContent.length) {
                        textPreview += '...';
                    }
                    $('#preview').editable("setValue", textPreview);
                }

                form.find('input[name="preview"]').val($('#preview').editable("getValue")['preview']);
                form.find('input[name="type"]').val($('#type').editable("getValue")['type']);
                form.find('input[name="display"]').val($('#status').editable("getValue")['status']);

                var formData = new FormData($('form#file-ajax')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    processData: false,
                    contentType: false,
                    data: formData,
                    async: false,
                    url: "/panel/admin/news/update",
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