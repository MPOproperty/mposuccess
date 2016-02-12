<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-shopping-cart"></i>@lang("mposuccess::profile.score.purchases")
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover" id="datatable_payments">
                <thead>
                <tr role="row" class="heading">
                    <th>
                        @lang('mposuccess::panel.transaction.id')
                    </th>
                    <th>
                        @lang('mposuccess::panel.transaction.price')
                    </th>
                    <th>
                        @lang('mposuccess::panel.transaction.date')
                    </th>
                    <th>
                         @lang('mposuccess::panel.transaction.description')
                     </th>
                    <th>
                    </th>
                </tr>
                <tr role="row" class="filter">
                    <td width="10%">
                        <input type="text" class="form-control form-filter input-sm" name="id">
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="price_from" placeholder="От"/>
                        </div>
                        <input type="text" class="form-control form-filter input-sm" name="price_to" placeholder="До"/>
                    </td>
                    <td width="20%">
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
                    <td width="40%">
                        <input type="text" class="form-control form-filter input-sm" name="description">
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