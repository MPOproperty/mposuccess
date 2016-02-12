<div class="row">
    <div class="col-md-12">
        <div class="portlet-body">
            <div class="col-lg-4">
                <div class="btn-group">
                    <a id="b-add" class="btn green" href="/panel/admin/product/update" data-target="#ajax" data-toggle="modal">
                        @lang('mposuccess::panel.add') <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover" id="table_products">
                <thead>
                <tr>
                    <th>
                        @lang('mposuccess::panel.products.name')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.desc')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.url')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.price')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.percent')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.cost')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.count')
                    </th>
                    <th>
                        @lang('mposuccess::panel.products.level')
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)
                    <tr class="odd gradeX">
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->des }}
                        </td>
                        <td>
                            {{ $product->url }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->percent }}
                        </td>
                        <td>
                            {{ round($product->price + ($product->percent * $product->price)/100, 2) }}
                        </td>
                        <td>
                            {{ $product->count > 0 ? $product->count : '[1..6]' }}
                        </td>
                        <td>
                            {{ $product->level }}
                        </td>
                        <td align="center">
                            <a href="/panel/admin/product/update/{{$product->id}}" class="btn default btn-xs purple b-edit" data-target="#ajax" data-toggle="modal">
                                <i class="fa fa-edit"></i> @lang('mposuccess::panel.edit') </a>
                            <a href="javascript:;" class="btn default btn-xs black b-delete" data-id-product="{{$product->id}}">
                                <i class="fa fa-trash-o"></i> @lang('mposuccess::panel.delete') </a>
                            <a href="javascript:;" style="display: none" class="loading-delete">
                                <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
                                <span>&nbsp;&nbsp;@lang('mposuccess::panel.loading')... </span></a>
                        </td>
                    </tr>
                @endforeach

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