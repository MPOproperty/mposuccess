{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> {{ $headerTitle }} </h4>
    </div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div id="errors"></div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td style='width:15%'> @lang('mpouspehm::panel.news.name') </td>
                    <td style="width:50%">
                        <a href="javascript:;" id="name" data-type="text" data-pk="1" data-placeholder="Required" data-original-title="@lang("mpouspehm::panel.enter") @lang("mpouspehm::panel.news.name")"> {{ !empty($news) ? $news->name : '' }} </a>
                    </td>
                </tr>
                <tr>
                    <td> @lang("mpouspehm::panel.news.status.title") </td>
                    <td>
                        <a href="javascript:;" id="status" data-type="select" data-pk="1" data-value="{{ !empty($news) ? $news->display : 1 }}" data-original-title="@lang("mpouspehm::panel.select") @lang("mpouspehm::panel.news.status.title")"></a>
                    </td>
                    </tr>
                <tr>
                    <td> @lang("mpouspehm::panel.news.type.title") </td>
                    <td>
                        <a href="javascript:;" id="type" data-type="select" data-pk="1" data-value="{{ !empty($news) ? $news->type : 1 }}" data-original-title="@lang("mpouspehm::panel.select") @lang("mpouspehm::panel.news.type.title")"></a>
                        </td>
                    </tr>
                <tr>
                    <td> @lang("mpouspehm::panel.news.content")
                        <a style="display: block" href="javascript:;" id="contentEdit">
                            <i class="fa fa-pencil"></i> [@lang('mpouspehm::panel.edit')] </a>
                    </td>
                    <td class="relative">
                        <div id="content" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="@lang('mpouspehm::panel.news.content')"> {{ !empty($news) ? $news->content : '' }} </div>
                    </td>
                </tr>
                <tr>
                    <td> @lang("mpouspehm::panel.news.preview")
                        <a style="display: block" href="javascript:;" id="previewEdit">
                            <i class="fa fa-pencil"></i> [@lang('mpouspehm::panel.edit')] </a>
                    </td>
                    <td class="relative">
                        <div id="preview" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="@lang('mpouspehm::panel.news.preview')"> {{ !empty($news) ? $news->preview : '' }} </div>
                    </td>
                </tr>
                <tr>
                    <td> @lang("mpouspehm::panel.news.img") </td>
                    <td>
                        <form id="file-ajax" enctype="multipart/form-data" method="post" name="file">

                            <input type="hidden" name="id" value="{{ !empty($news) ? $news->id : 0 }}" />
                            <input type="hidden" name="name" value="" />
                            <input type="hidden" name="content" value="" />
                            <input type="hidden" name="preview" value="" />
                            <input type="hidden" name="type" value="" />
                            <input type="hidden" name="display" value="" />

                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn default btn-file">
                                    <span class="fileinput-new">
                                        @lang("mpouspehm::panel.select") @lang("mpouspehm::panel.file") </span>
                                    <span class="fileinput-exists">
                                        @lang("mpouspehm::panel.change") </span>
                                    <input type="file" name="file">
                                </span>
                                <span class="fileinput-filename"></span>
                                &nbsp; <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
                            </div>
                        </form>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">@lang('mpouspehm::panel.cancel')</button>
    <button id="save" type="button" class="btn blue">@lang('mpouspehm::panel.save')</button>
    <a href="javascript:;" style="display: none" class="loading-save">
        <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
        <span>&nbsp;&nbsp;@lang('mpouspehm::panel.loading')... </span></a>
</div>

{!! \Assets::js() !!}

<script>
    jQuery(document).ready(function() {
        FormEditable.init();
    });
</script>