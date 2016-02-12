<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ $user->url_avatar ? $user->url_avatar : '/images/users/default.jpg' }}"
                         class="img-responsive" alt="">
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
                        <a href="/panel/user/{{ $user->refer }}" data-target="#ajax" data-toggle="modal"
                           class="btn btn-circle green-haze btn-sm">@lang('mposuccess::profile.refer')</a>
                    @endif
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="/panel/personal/">
                                    <i class="icon-note"></i>@lang('mposuccess::profile.personalInfo.title')
                                </a>
                            </li>
                            <li class="active">
                                <a href="/panel/partner/">
                                    <i class="icon-users"></i>@lang('mposuccess::profile.partnerProgram.title')
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
                                <span class="caption-subject font-blue-madison bold uppercase">@lang('mposuccess::profile.partnerProgram.title')</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PARTNER PROGRAM TAB -->

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="portlet blue-hoki box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>@lang('mposuccess::profile.instruction')
                                                        : {{ $program->name or trans('mposuccess::panel.unknown') }}
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="slimScrollDiv">
                                                        <div class="full-height-content-body" style="height: 210px">
                                                            {!! $program->description or '' !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="portlet sale-summary">
                                                <div class="portlet-title">
                                                    <div class="caption" style="font-size: 16px;">
                                                        @lang('mposuccess::profile.partnerProgram.statisticReferrals')
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
                                                                <span class="sale-info">@lang('mposuccess::profile.structures.'.$level ) @lang('mposuccess::profile.partnerProgram.level')
                                                                    <i class="fa fa-img-up"></i></span>
                                                                <span class="sale-num">{{ $value }} </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label">@lang('mposuccess::profile.partnerProgram.refLink')</label>

                                            <div id="copy-block" style="position: relative">
                                                <input type="text" class="form-control"
                                                       value="{{ url('') . config('mposuccess.register_url') . $user->sid }}"
                                                       disabled>

                                                <div id="copy-button"
                                                     data-clipboard-text="{{ url('') . config('mposuccess.register_url') . $user->sid }}"
                                                     title="@lang('mposuccess::profile.copyInBuffer')"
                                                     style="position: absolute; top: 0; right: 0; cursor: pointer"
                                                     class="btn blue">
                                                    <i class="fa fa-copy"></i> @lang('mposuccess::profile.copy')</div>
                                            </div>
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
