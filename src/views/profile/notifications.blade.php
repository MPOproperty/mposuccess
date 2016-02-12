<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-shopping-cart"></i>@lang("mposuccess::panel.notification.list")
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover" id="datatable_notifications">
                <thead>
                <tr role="row" class="heading">
                    <th width="5%">
                        @lang("mposuccess::panel.notification.name")
                    </th>
                    <th width="15%">
                        @lang("mposuccess::panel.notification.text")
                    </th>
                    <th width="10%">
                        @lang("mposuccess::panel.notification.date")
                    </th>
                    <th width="10%">
                        @lang("mposuccess::panel.notification.status")
                    </th>
                    <th width="10%">
                        @lang("mposuccess::panel.tools")
                    </th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="name">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="text">
                    </td>
                    <td>
                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" name="date_from" placeholder="От">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                        <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control form-filter input-sm" name="date_to" placeholder="Дo">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <select name="status" class="form-control form-filter input-sm">
                            <option value="-1">@lang("mposuccess::panel.select")...</option>
                            <option value="1">@lang("mposuccess::panel.notification.status-read")</option>
                            <option value="0">@lang("mposuccess::panel.notification.status-unread")</option>
                        </select>
                    </td>
                    <td align="center">
                        <div class="margin-bottom-5" >
                            <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> @lang("mposuccess::panel.search")</button>
                        </div>
                        <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> @lang("mposuccess::panel.reset")</button>
                    </td>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg"></div>
</div>

<script>

    var messages = [];
    messages['loading'] = "@lang('mposuccess::panel.loading')";

</script>

