{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> {{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }} </h4>
    </div>
<div class="modal-body view">

    <div class="clearfix" style="text-align: center">
        <a href="javascript:;" class="btn default red-stripe">
            1 @lang('mpouspehm::panel.tree') </a>
        <a href="javascript:;" class="btn default blue-stripe">
            2 @lang('mpouspehm::panel.tree') </a>
        <a href="javascript:;" class="btn default green-stripe">
            3 @lang('mpouspehm::panel.tree') </a>
        <a href="javascript:;" class="btn default yellow-stripe">
            4 @lang('mpouspehm::panel.tree') </a>
        <a href="javascript:;" class="btn default purple-stripe">
            5 @lang('mpouspehm::panel.tree') </a>
        <a href="javascript:;" class="btn default green-stripe">
            6 @lang('mpouspehm::panel.tree') </a>
    </div>

    <div class="portlet">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.email')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.birthday')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{ $user->birthday }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.created/updated')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{ $user->created_at .  $user->updated_at != $user->created_at ? $user->updated_at : '' }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.program')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{ $user->getProgram ? $user->getProgram->name : '&nbsp;' }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.country')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">
                                <?= $user->getCountry ? '<img src="/assets/img/flags/' . $user->getCountry->flag . '.png"/> ' . $user->getCountry->name : '&nbsp;' ?></p>
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.phone')</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{ $user->phone or '&nbsp;' }}</p>
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
</div>

{!! \Assets::js() !!}

<script>
    /*jQuery(document).ready(function() {
        FormEditable.init();
    });*/
</script>