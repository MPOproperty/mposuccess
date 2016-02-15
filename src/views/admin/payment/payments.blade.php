<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-shopping-cart"></i>@lang("mpouspehm::panel.transaction.list")
        </div>
        <div class="actions">
            <a href="/panel/admin/payments/create" class="btn default yellow-stripe">
                <i class="fa fa-plus"></i>
                <span class="hidden-480">
                    @lang('mpouspehm::panel.add') </span>
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
            <table class="table table-striped table-bordered table-hover" id="datatable_payments">
                <thead>
                <tr role="row" class="heading">
                    <th width="2%">
                        <input type="checkbox" class="group-checkable">
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.id')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.status')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.type')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.user')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.price')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.from')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.to')
                    </th>
                    <th>
                        @lang('mpouspehm::panel.transaction.date')
                    </th>
                    <th>
                    </th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                    </td>
                    <td width="7%">
                        <input type="text" class="form-control form-filter input-sm" name="id">
                    </td>
                    <td width="10%">
                        <select name="status" class="form-control form-filter input-sm">
                            <option value="">@lang('mpouspehm::panel.transaction.status')</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->description }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="type" class="form-control form-filter input-sm">
                            <option value="">@lang('mpouspehm::panel.transaction.type')</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="creator">
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="price_from" placeholder="От"/>
                        </div>
                        <input type="text" class="form-control form-filter input-sm" name="price_to" placeholder="До"/>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="from">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="to">
                    </td>
                    <td width="14%">
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