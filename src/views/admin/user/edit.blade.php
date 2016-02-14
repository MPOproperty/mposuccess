{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> @lang('mpouspehm::panel.user.edit')</h4>
    </div>
<div class="modal-body view">

    <div class="portlet">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.surname')</label>
                        <div class="col-md-9">
                            <input name="surname" type="text" placeholder="@lang('mpouspehm::panel.user.surname')" class="form-control" value="{{ $user->surname }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.name')</label>
                        <div class="col-md-9">
                            <input name="name" type="text" placeholder="@lang('mpouspehm::panel.user.name')" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.patronymic')</label>
                        <div class="col-md-9">
                            <input name="patronymic" type="text" placeholder="@lang('mpouspehm::panel.user.patronymic')" class="form-control" value="{{ $user->patronymic }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.birthday')</label>
                        <div class="col-md-9">
                            <span class="input-group date date-picker" data-date-format="dd.mm.yyyy">
                                <input type="text" class="form-control form-filter input-sm" name="birthday"
                                       placeholder="01.01.1990" value="{{ date_format(date_create($user->birthday), 'd.m.Y') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.email')</label>
                        <div class="col-md-9">
                            <input type="text" id="email" name="email" placeholder="name@gmail.com" class="form-control" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.phone')</label>
                        <div class="col-md-9">
                            <input class="form-control" id="phone" name="phone" type="text" placeholder="(44) 123-45-67"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.country')</label>
                        <div class="col-md-9">
                            <select name="country" id="select2_country" class="form-control select2 input-sm" data-placeholder="@lang('mpouspehm::profile.regionNoSelect')">
                                @foreach ($countries as $country)
                                    <option value="{{ $country['code'] }}" data-country="{{ $country['flag'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.program')</label>
                        <div class="col-md-9">
                            <select id="select2_program" class="form-control input-sm">
                                @foreach ($programs as $program)
                                    <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group last">
                        <label class="control-label col-md-3">@lang('mpouspehm::panel.user.role')</label>
                        <div class="col-md-9">
                            <select id="select2_role" class="form-control input-sm">
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
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
    $("#phone").inputmask("mask", {
        "mask": "(999) 999-99-99",
        "clearIncomplete": true
    }).val("{{ $user->phone }}");

    //init date pickers
    $('.date-picker').datepicker({
        startDate: '-100y',
        endDate: '-18y',
        language: 'ru'
    });

    function formatCountry(state) {
        if (!state.id) return state.text; // optgroup
        return "<img class='flag' src='/assets/img/flags/" + $(state.element).data('country') + ".png'/>&nbsp;&nbsp;" + state.text;
    }
    $("#select2_country").select2({
        allowClear: true,
        formatResult: formatCountry,
        formatSelection: formatCountry,
        escapeMarkup: function (m) {
            return m;
        }
    }).select2("val", "{{ $user->country }}");

    $('#select2_program').select2().select2("val", "{{ $user->program }}");

    $('#select2_role').select2().select2("val", "{{ $user->getRole ? $user->getRole->role_id : '' }}");

    $('#save').click(function(){
        var self = this;

        $(self).parent().find('button, a').toggle();

        $('.has-error').removeClass('has-error')
                .find('.help-block').remove();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: 'json',
            data: {
                surname: $('input[name="surname"]').val(),
                name: $('input[name="name"]').val(),
                patronymic: $('input[name="patronymic"]').val(),
                birthday: $('input[name="birthday"]').val(),
                email: $('#email').val(),
                phone: $('input[name="phone"]').val(),
                program: $('#select2_program').val(),
                country: $('#select2_country').val(),
                role: $('#select2_role').val()
            },
            url: "/panel/admin/user/{{$user->id}}/save",
            cache: false,
            success: function (response) {
                switch (response.status) {
                    case 'success':
                        location.reload();
                        break;
                    case 'error':
                        $(self).parent().find('button, a').toggle();

                        $.each(response.data, function(index, value) {

                            if(index == 'role') {
                                $('#select2_role')
                                    .parent().addClass('has-error')
                                    .append('<span class="help-block">' + value + '</span>');
                            }

                            if(index != 'birthday') {
                                $('input[name="' + index + '"]')
                                    .parent().addClass('has-error')
                                    .append('<span class="help-block">' + value + '</span>');
                            } else {
                                $('input[name="' + index + '"]')
                                    .parent().parent().addClass('has-error')
                                    .append('<span class="help-block">' + value + '</span>');
                            }

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