var TableWithdrawal = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    };

    var handlePayments = function (urlToAjax) {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_withdrawal"),
            onSuccess: function (grid) {
                $.ajax({
                    url: '/panel/balance',
                    headers: {
                        'X-CSRF-Token': $('meta[name=_token]').attr('content')
                    },
                    method: "GET"
                }).done(function (response) {
                    $("#header_balance_show").text(response);
                });
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options
                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                "lengthMenu": [
                    [2, 10, 20, 50, 100, 150, -1],
                    [2, 10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "columns": [
                    {
                        "name": 'id'
                    },
                    {
                        "name": 'status'
                    },
                    {
                        "name": 'method'
                    },
                    {
                        "name": 'creator'
                    },
                    {
                        "name": 'price'
                    },
                    {
                        "name": 'date'
                    }, {
                        "orderable": false
                    }],
                "ajax": {
                    "url": urlToAjax // ajax source
                },
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });

        grid.getTableWrapper().on('click', '.b-edit', function (e) {
         $(this).parent().parent().addClass('warning');

            if (confirm('Вы действительно хотите изменить статус?')) {
                $(this).parent().parent().removeClass('warning').addClass('danger');

                $(this).parent().find('a').toggle();

                var self = this;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: $(this).attr('href'),
                    cache: false,
                    success: function (response) {
                        $("#datatable_withdrawal").dataTable().fnDraw();
                    }
                });

            } else {
                $(this).parent().parent().removeClass('warning');
            }
        });
    }

    return {

        //main function to initiate the module
        init: function (urlToAjax) {

            initPickers();
            handlePayments(urlToAjax);
        }

    };

}();