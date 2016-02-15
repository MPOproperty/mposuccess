{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> @lang('mpouspehm::panel.entity.edit')</h4>
    </div>
<div class="modal-body view">

    <div class="portlet">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form id="form" action="#" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.entity.name')</label>
                        <div class="col-md-9">
                            <input name="name" type="text" placeholder="@lang('mpouspehm::panel.entity.name')" class="form-control" value="{{ $entity->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.entity.description')</label>
                        <div class="col-md-9">
                            <input name="description" type="text" placeholder="@lang('mpouspehm::panel.entity.description')" class="form-control" value="{{ $entity->description }}">
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.entity.image')</label>
                        <div class="col-md-9">
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
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
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
    $('#save').click(function(){
        var self = this;

        $(self).parent().find('button, a').toggle();

        $('.has-error').removeClass('has-error')
                .find('.help-block').remove();

        var formData = new FormData($('form#form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            url: "/panel/admin/entity/{{$entity->id}}/save",
            cache: false,
            success: function (response) {
                switch (response.status) {
                    case 'success':
                        location.reload();
                        break;
                    case 'error':
                        $(self).parent().find('button, a').toggle();

                        $.each(response.data, function(index, value) {
                            if (index == 'title') index = 'name';
                            $('form input[name="' + index + '"]')
                                .parent().addClass('has-error')
                                .append('<span class="help-block">' + value + '</span>');

                        });
                        break;
                    default:
                        $(self).parent().find('button, a').toggle();

                        alert(response);
                }
            }
        });
    });
</script>