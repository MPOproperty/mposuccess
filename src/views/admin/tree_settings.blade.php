<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">@lang('mpouspehm::admin.tree_settings')</span>
                    </div>
                </div>
            </div>
            @foreach($settings as $level)
                <div class="panel-group accordion" id="accordion{{$level['level']}}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse"
                                   data-parent="#accordion{{$level['level']}}"
                                   href="#collapse_{{$level['level']}}" aria-expanded="true">
                                    @lang('mpouspehm::admin.structure' . $level['level'])</a>
                            </h4>
                        </div>
                        <div id="collapse_{{$level['level']}}" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <form id="form-change-settings-structure" method="post"
                                      action="{{ route(config('mpouspehm.panel_admin_url') . '.postSettings') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @foreach($level as $param => $value)
                                        <div class="form-group">
                                            @if($param == 'level')
                                                <input type="hidden" name={{ $param }} value={{ $value }}>
                                            @elseif(($level['level'] == 3 || $level['level'] == 6) && ($param == 'first_pay' || $param == 'next_pay'))
                                                <input type="hidden" name={{ $param }} value={{ $value }}>
                                            @elseif($param!='invited' || $level['level']==3 || $level['level']==6)
                                                <label class="control-label">@lang('mpouspehm::admin.settings.' . $param)</label>
                                                <input type="text" name={{ $param }} class="form-control" value={{ $value }}>
                                            @else
                                                <input type="hidden" name="{{ $param }}" value="{{ $value }}">
                                                @if($errors->has($param))
                                                    <span id="name-error" class="help-block">{{$errors->first($param)}}</span>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                    <div>
                                        <button type="submit" class="btn green-haze">
                                            @lang('mpouspehm::admin.settings.save_settings')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
