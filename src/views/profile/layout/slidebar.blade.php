<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="start @if(config('mpouspehm.panel_url') . '.panel' == Route::currentRouteName()) active @endif">
                <a href="{{ route(config('mpouspehm.panel_url') . '.panel') }}">
                    <i class="icon-note"></i>
                    <span class="title">@lang('mpouspehm::profile.dashboard')</span>
                </a>
            </li>

            <li @if(config('mpouspehm.panel_url') . '.news' == Route::currentRouteName() ||
                        Request::is(config('mpouspehm.panel_url') . '/post/*')) class="active" @endif >
                <a href="{{ route(config('mpouspehm.panel_url') . '.news') }}">
                    <i class="icon-book-open"></i>
                    <span class="title">@lang('mpouspehm::profile.news')</span>
                </a>
            </li>

            <li @if(Request::is('*/score/*')) class="active open" @endif>
                <a href="javascript:;">
                    <i class="icon-wallet"></i>
                    <span class="title">@lang('mpouspehm::profile.score.title')</span>
                    <span class="arrow @if(Request::is('*/score/*')) open @endif"></span>
                </a>
                <ul class="sub-menu">
                    <li @if(config('mpouspehm.panel_url') . '.operations' == Route::currentRouteName()) class="active" @endif>
                        <a href="{{ route(config('mpouspehm.panel_url') . '.operations') }}">
                            <i class="icon-bulb"></i>
                            @lang('mpouspehm::profile.score.operations')</a>
                    </li>
                    <li @if(config('mpouspehm.panel_url') . '.purchases' == Route::currentRouteName()) class="active" @endif>
                        <a href="{{ route(config('mpouspehm.panel_url') . '.purchases') }}">
                            <i class="icon-handbag"></i>
                            @lang('mpouspehm::profile.score.purchases')</a>
                    </li>
                    <li @if(config('mpouspehm.panel_url') . '.bonuses' == Route::currentRouteName()) class="active" @endif>
                        <a href="{{ route(config('mpouspehm.panel_url') . '.bonuses') }}">
                            <i class="icon-handbag"></i>
                            @lang('mpouspehm::profile.score.bonuses')</a>
                    </li>
                    <li @if(config('mpouspehm.panel_url') . '.myOperations' == Route::currentRouteName()) class="active" @endif>
                        <a href="{{ route(config('mpouspehm.panel_url') . '.myOperations') }}">
                            <i class="icon-handbag"></i>
                            @lang('mpouspehm::profile.score.myOperations')</a>
                    </li>
                </ul>
            </li>

            <li @if(config('mpouspehm.panel_url') . '.catalog' == Route::currentRouteName()) class="active" @endif>
                <a href="{{ route(config('mpouspehm.panel_url') . '.catalog') }}">
                    <i class="icon-basket"></i>
                    <span class="title">@lang('mpouspehm::profile.catalog')</span>
                </a>
            </li>

            <li @if(config('mpouspehm.panel_url') . '.structures' == Route::currentRouteName()) class="active open" @endif>
                <a href="javascript:;">
                    <i class="icon-vector"></i>
                    <span class="title">@lang('mpouspehm::profile.structures.title')</span>
                    <span class="arrow @if(config('mpouspehm.panel_url') . '.structures' == Route::currentRouteName()) open @endif"></span>
                </a>
                <ul class="sub-menu">
                    <li @if(Request::is('*/structures/1*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/1">
                            <i class="icon-share"></i>
                            @lang('mpouspehm::profile.structures.1')</a>
                    </li>
                    <li @if(Request::is('*/structures/2*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/2">
                            <i class="icon-share"></i>
                            @lang('mpouspehm::profile.structures.2')</a>
                    </li>
                    <li @if(Request::is('*/structures/3*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/3">
                            <i class="icon-graph"></i>
                            @lang('mpouspehm::profile.structures.3')</a>
                    </li>
                    <li @if(Request::is('*/structures/4*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/4">
                            <i class="icon-share"></i>
                            @lang('mpouspehm::profile.structures.4')</a>
                    </li>
                    <li @if(Request::is('*/structures/5*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/5">
                            <i class="icon-share"></i>
                            @lang('mpouspehm::profile.structures.5')</a>
                    </li>
                    <li @if(Request::is('*/structures/6*')) class="active" @endif>
                        <a href="/{{config('mpouspehm.panel_url')}}/structures/6">
                            <i class="icon-graph"></i>
                            @lang('mpouspehm::profile.structures.6')</a>
                    </li>
                </ul>
            </li>

            <li @if(config('mpouspehm.panel_url') . '.tree' == Route::currentRouteName()) class="active" @endif>
                <a href="{{ route(config('mpouspehm.panel_url') . '.tree') }}">
                    <i class="icon-list"></i>
                    <span class="title">@lang('mpouspehm::profile.tree')</span>
                </a>
            </li>
            <li @if('mpouspehm.panel_url' == Route::currentRouteName()) class="active" @endif>
                <a href="{{ route(config('mpouspehm.panel_url') . '.bonus') }}">
                    <i class="icon-present"></i>
                    <span class="title">@lang('mpouspehm::profile.program.title')</span>
                </a>
            </li>
            <li>
                <a href="http://{{ config('mpouspehm.landing_host') }}" target="_blank">
                    <i class="icon-question"></i>
                    <span class="title">@lang('mpouspehm::profile.helper')</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->