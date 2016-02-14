<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-shopping-cart"></i>@lang("mpouspehm::panel.user.list")
        </div>
        <div class="actions">
            <a href="javascript:;" class="btn default yellow-stripe">
                <i class="fa fa-plus"></i>
								<span class="hidden-480">
								New Order </span>
            </a>
            <div class="btn-group">
                <a class="btn default yellow-stripe dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                    <i class="fa fa-share"></i>
									<span class="hidden-480">
									Tools </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;">
                            Export to Excel </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            Export to CSV </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            Export to XML </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="javascript:;">
                            Print Invoices </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <div class="table-actions-wrapper">
                <span></span>
                <select class="table-group-action-input form-control input-inline input-small input-sm" style="width: 110px!important;">
                    <option value="">@lang("mpouspehm::panel.tool")</option>
                    <option value="Cancel">Cancel</option>
                    <option value="Cancel">Hold</option>
                    <option value="Cancel">On Hold</option>
                    <option value="Close">Close</option>
                </select>
                <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
            </div>
            <table class="table table-striped table-bordered table-hover" id="datatable_users">
                <thead>
                <tr role="row" class="heading">
                    <th width="2%">
                        <input type="checkbox" class="group-checkable">
                    </th>
                    <th width="5%">
                        @lang("mpouspehm::panel.user.sid")
                    </th>
                    <th width="15%">
                        @lang("mpouspehm::panel.user.fio")
                    </th>
                    <th width="10%">
                        @lang("mpouspehm::panel.user.email")
                    </th>
                    <th width="10%">
                        @lang("mpouspehm::panel.user.balance")
                    </th>
                    <th width="10%">
                        @lang("mpouspehm::panel.user.role")
                    </th>
                    <th width="10%">
                        @lang("mpouspehm::panel.tools")
                    </th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="sid">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="fio">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="email">
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="balance_from" placeholder="От"/>
                        </div>
                        <input type="text" class="form-control form-filter input-sm" name="balance_to" placeholder="До"/>
                    </td>
                    <td>
                        <select name="role" class="form-control form-filter input-sm">
                            <option value="">@lang("mpouspehm::panel.select")...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td align="center">
                        <div class="margin-bottom-5" >
                            <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> @lang("mpouspehm::panel.search")</button>
                        </div>
                        <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> @lang("mpouspehm::panel.reset")</button>
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
    messages['loading'] = "@lang('mpouspehm::panel.loading')";

</script>

