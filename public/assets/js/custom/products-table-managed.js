var TableManaged = function () {

    var initTableProducts = function () {

        var table = $('#table_products');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            },{
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#table_products_wrapper');

        table.on("click", '.b-edit', function (e) {
            $('#ajax .modal-dialog').html(
                '<div class="modal-content">' +
                    '<div class="modal-body">' +
                        '<img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">' +
                        '<span>&nbsp;&nbsp;' + messages['loading'] + '... </span>' +
                    '</div>' +
                '</div>'
            );
        });

        table.on("click", '.b-delete', function (e) {
            $(this).parent().parent().addClass('warning');

            if (confirm('Вы действительно желаете удалить новость?')) {
                $(this).parent().parent().removeClass('warning').addClass('danger');

                $(this).parent().find('a').toggle();

                var self = this;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/panel/admin/product/delete/" + $(self).attr('data-id-product'),
                    cache: false,
                    success: function (response) {
                        $(self).parent().find('a').toggle();

                        if(response) {
                            var nRow = $(self).parents('tr')[0];
                            table.fnDeleteRow(nRow);
                        } else {
                            $(self).parent().parent().removeClass('danger');
                        }
                    }
                 });

            } else {
                $(this).parent().parent().removeClass('warning');
            }
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline") // modify table per page dropdown
        tableWrapper.find('.dataTables_length label').css('float', 'right');
        tableWrapper.find('.dataTables_filter label').css('float', 'left');

        tableWrapper.find('div.row:first-of-type').prepend($('#table_products_filter').parent());

        tableWrapper.find('div.row:first-of-type > div').removeClass().addClass('col-md-4');

        tableWrapper.find('div.row:first-of-type').prepend($('#b-add').parent().parent());
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTableProducts();
        }

    };

}();

<!-- only for page "panel/admin/news" -->
TableManaged.init();
$('body').on("click", '#b-add', function (e) {
    $('#ajax .modal-dialog').html(
        '<div class="modal-content">' +
        '<div class="modal-body">' +
        '<img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">' +
        '<span>&nbsp;&nbsp;' + messages['loading'] + '... </span>' +
        '</div>' +
        '</div>'
    );
});