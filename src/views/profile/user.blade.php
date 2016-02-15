{!! \Assets::css() !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"> {{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }} </h4>
</div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-3">
            <ul class="list-unstyled profile-nav">
                <li>
                    <img src="{{ $user->url_avatar ? $user->url_avatar : '/images/users/default.jpg' }}" class="img-responsive" alt=""/>
                </li>
                <li class="messageButton">
                    <button type="button" class="btn btn-circle btn-danger btn-sm">@lang('mpouspehm::profile.message')</button>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 profile-info">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-envelope"></i> {{ $user->email }}
                        </li>
                        @if($user->phone != '')
                            <li>
                                <i class="fa fa-phone-square"></i> {{ '(' . substr($user->phone, 0,3) . ') ' . substr($user->phone, 3,3) . '-' . substr($user->phone, 6,2) . '-'. substr($user->phone, 8,2)  }}
                            </li>
                        @endif
                        <li>
                            <i class="fa fa-map-marker"></i>
                            @if ($country)
                                <img class='flag' src='/assets/img/flags/{{ $country->flag }}.png'/>&nbsp;&nbsp; {{ $country->name }}
                            @else
                               unknown
                            @endif
                        </li>
                        <li>
                            <i class="fa fa-calendar"></i> {{ $user->birthday or 'unknown' }}
                        </li>
                        @if($user->id != 1)
                            <li>
                                <i class="fa fa-home"></i> <a href="/profile/user/{{ $user->refer }}">{{ $refer or "unknown" }}</a>
                            </li>
                        @endif
                        <li>
                            <i class="fa fa-trophy"></i> {{ $program->name or "unknown" }}
                        </li>
                        <li>
                            <i class="fa fa-history"></i> {{ $user->created_at }}
                        </li>
                    </ul>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">@lang('mpouspehm::panel.cancel')</button>
</div>

{!! \Assets::js() !!}