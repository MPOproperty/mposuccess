<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ $user->url_avatar ? $user->url_avatar : '/images/users/default.jpg' }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{ $user->surname }} {{ $user->name }}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    @if($refer)
                        <a href="/panel/user/{{ $user->refer }}" data-target="#ajax" data-toggle="modal" class="btn btn-circle green-haze btn-sm">@lang('mpouspehm::profile.refer')</a>
                    @endif
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="/panel/personal/">
                                    <i class="icon-note"></i>@lang('mpouspehm::profile.personalInfo.title')
                                </a>
                            </li>
                            <li>
                                <a href="/panel/partner/">
                                    <i class="icon-users"></i>@lang('mpouspehm::profile.partnerProgram.title')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END SIDEBAR BUTTONS -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="row text-center">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">@lang('mpouspehm::profile.title')</span>
                            </div>
                            <ul class="nav nav-tabs" style="float: inherit">
                                <li @if (!in_array(Session::get('tab'), [2,3])) class="active" @endif>
                                    <a href="#tab_1_1" data-toggle="tab">@lang('mpouspehm::profile.personalInfo.title')</a>
                                </li>
                                <li @if (Session::get('tab') === 2) class="active" @endif>
                                    <a href="#tab_1_2" data-toggle="tab">@lang('mpouspehm::profile.changeAvatar.title')</a>
                                </li>
                                <li @if (Session::get('tab') === 3) class="active" @endif>
                                    <a href="#tab_1_3" data-toggle="tab">@lang('mpouspehm::profile.changePassword.title')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane @if (!in_array(Session::get('tab'), [2,3])) active @endif" id="tab_1_1">
                                    <form id="form-change-data" method="post" action="{{ route(config('mpouspehm.panel_url') . '.changeData') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group @if($errors->has('surname')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.surname')</label>
                                            <input type="text" name="surname" placeholder="@lang('mpouspehm::profile.personalInfo.surnamePlaceholder')"
                                                   class="form-control" value="{{ Input::old('surname', $user->surname) }}">
                                            @if($errors->has('surname'))
                                                <span id="name-error" class="help-block">{{ $errors->first('surname') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group @if($errors->has('name')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.name')</label>
                                            <input type="text" name="name" placeholder="@lang('mpouspehm::profile.personalInfo.namePlaceholder')"
                                                   class="form-control" value="{{ old('name', $user->name) }}">
                                            @if($errors->has('name'))
                                                <span id="name-error" class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group @if($errors->has('patronymic')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.patronymic')</label>
                                            <input type="text" name="patronymic" placeholder="@lang('mpouspehm::profile.personalInfo.patronymicPlaceholder')"
                                                   class="form-control" value="{{ old('patronymic', $user->patronymic) }}">
                                            @if($errors->has('patronymic'))
                                                <span id="name-error" class="help-block">{{ $errors->first('patronymic') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('birthday')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.dataBirth')</label>
                                            <span class="input-group date date-picker" data-date-format="dd.mm.yyyy">
                                                <input type="text" class="form-control form-filter input-sm" name="birthday"
                                                       placeholder="01.01.1990" value="{{ old('birthday', date_format(date_create($user->birthday), 'd.m.Y')) }}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                </span>
                                            </span>
                                            @if($errors->has('birthday'))
                                                <span id="name-error" class="help-block">{{ $errors->first('birthday') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group @if($errors->has('email')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.email')</label>
                                            <input type="text" name="email" placeholder="name@gmail.com" class="form-control" value="{{ old('email', $user->email) }}">
                                            @if($errors->has('email'))
                                                <span id="name-error" class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.phone')</label>
                                            <input class="form-control" id="phone" name="phone" type="text" placeholder="(44) 123-45-67"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.region')</label>
                                            <select name="country" id="select2_country" class="form-control select2 input-sm" data-placeholder="@lang('mpouspehm::profile.regionNoSelect')" disabled>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['code'] }}" data-country="{{ $country['flag'] }}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.instruction')</label>
                                            <select id="select2_program" class="form-control input-sm" data-placeholder="@lang('mpouspehm::profile.instructionNoSelect')" disabled>
                                                @if ($program)
                                                    <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                                                @endif
                                            </select>
                                        </div>

                                        @if($user['id'] != 1)
                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.refer')</label>
                                            <input type="text" placeholder="@lang('mpouspehm::profile.referNone')" class="form-control" value="{{ $refer or "" }}" disabled>
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.personalInfo.dateRegister')</label>
                                            <input type="text" class="form-control" value="{{ $user->created_at }}" disabled>
                                        </div>

                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mpouspehm::profile.saveChanges')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 2) active @endif" id="tab_1_2">
                                    <form id="form-change-avatar" method="post" action="{{ route(config('mpouspehm.panel_url') . '.changeAvatar') }}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            @lang('mpouspehm::profile.changeAvatar.selectImage')</span>
                                                        <input type="file" name="photo">
                                                    </span>
                                                    <a href="{{ url('profile/removeAvatar') }}" class="btn default fileinput-exists"
                                                        data-dismiss="fileinput" @if(!$user->url_avatar) disabled @endif>
                                                        @lang('mpouspehm::profile.changeAvatar.remove')</a>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">@lang('mpouspehm::profile.note')</span>
                                                <span>@lang('mpouspehm::profile.changeAvatar.help')</span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mpouspehm::profile.submit')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 3) active @endif" id="tab_1_3">
                                    <form id="form-change-password" method="post" action="{{ route(config('mpouspehm.panel_url') . '.changePassword') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group @if($errors->has('current')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.changePassword.current')</label>
                                            <input type="password" name="current" class="form-control" value="{{ old('current') }}">
                                            @if($errors->has('current'))
                                                <span id="name-error" class="help-block">{{ $errors->first('current') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group  @if($errors->has('password')) has-error @endif">
                                            <label class="control-label">@lang('mpouspehm::profile.changePassword.new')</label>
                                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                            @if($errors->has('password'))
                                                <span id="name-error" class="help-block">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.changePassword.reType')</label>
                                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green-haze">
                                                @lang('mpouspehm::profile.changePassword.title')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                                <!-- PARTNER PROGRAM TAB -->
                                <div class="tab-pane @if (Session::get('tab') === 4) active @endif" id="tab_1_4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="portlet blue-hoki box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>@lang('mpouspehm::profile.instruction')
                                                        : {{ $program->name or trans('mpouspehm::panel.unknown') }}
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="slimScrollDiv">
                                                        <div class="full-height-content-body" style="height: 210px">
                                                            <p>{{ $program->description or 'mpouspehm::profile.instruction.instructionDescription.one' }}</p>
                                                            <p>{{ $program->description or 'mpouspehm::profile.instruction.instructionDescription.two' }}</p>
                                                            <p>{{ $program->description or 'mpouspehm::profile.instruction.instructionDescription.three' }}</p>
                                                            <p>{{ $program->description or 'mpouspehm::profile.instruction.instructionDescription.four' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="portlet sale-summary">
                                                <div class="portlet-title">
                                                    <div class="caption" style="font-size: 16px;">
                                                        @lang('mpouspehm::profile.partnerProgram.statisticReferrals')
                                                    </div>
                                                    <!--div class="tools">
                                                        <a class="reload" href="javascript:;">
                                                        </a>
                                                    </div-->
                                                </div>
                                                <div class="portlet-body">
                                                    <ul class="list-unstyled">
                                                        @foreach($countPlaces as $level => $value)
                                                            <li>
                            <span class="sale-info">
							{{ $level }} @lang('mpouspehm::profile.partnerProgram.level')
                                <i class="fa fa-img-up"></i>
                            </span>
                            <span class="sale-num">
                                {{ $value }} </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label">@lang('mpouspehm::profile.partnerProgram.refLink')</label>
                                            <div id="copy-block" style="position: relative">
                                                <input type="text" class="form-control"
                                                       value="{{ url('') . config('mpouspehm.register_url') . $user->sid }}" disabled>
                                                <div id="copy-button"
                                                     data-clipboard-text="{{ url('') . config('mpouspehm.register_url') . $user->sid }}"
                                                     title="@lang('mpouspehm::profile.copyInBuffer')"
                                                     style="position: absolute; top: 0; right: 0; cursor: pointer" class="btn blue">
                                                    <i class="fa fa-copy"></i> @lang('mpouspehm::profile.copy')</div>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-8">
										Офферта Превью
										</div>
									</div>
                                </div>
                            </div>
                                </div>
                                <!-- END PARTNER PROGRAM TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>

<div class="modal fade" id="ajax" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/images/pages/loading-spinner-grey.gif" alt="" class="loading">
                <span>&nbsp;&nbsp; + messages['loading'] + ... </span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dataUser = [];

    dataUser['country'] = "{{ $user->country }}";
    dataUser['program'] = "{{ $user->program }}";
    dataUser['phone'] = "{{ old('phone', $user->phone) }}";

</script>