<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="/">
                <img src="/images/logo-png.png" alt="MPOSUCCESS" width="70%">
                <!--span>TEACHER</span>
                <span>LOG</span-->
                <!--<img src="../../assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>-->
            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN HEADER SEARCH BOX -->
        <form class="search-form" action="extra_search.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
            </div>
        </form>
        <!-- END HEADER SEARCH BOX -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>

        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                @if(isset($balance))
                <li class="dropdown dropdown-extended tooltip-wrap">
                    <a href="javascript:SwapDivsWithClick('header_balance_show','header_balance_hide')" class="dropdown-toggle">
                        <div id="header_balance_show" class="tooltips" data-placement="bottom" title="@lang('mpouspehm::panel.balance_hide')" style="display: block">{{ $balance }} </div>
                        <div id="header_balance_hide" class="tooltips" data-placement="bottom" title="@lang('mpouspehm::panel.balance_show')" style="display: none">************ </div>
                    </a>
                </li>
                @endif
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span @if(!$notification_new) style="display: none" @endif class="badge badge-default" id="notification-count">
                            {{$notification_new}}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>@lang('mpouspehm::profile.topmenu.notifications.pending')<span class="bold">{{$notification_count}}</span></h3>
                            <a href="/panel/notifications"><i style="color: rgb(98, 135, 143);" class="fa fa-archive"></i></a>
                            <div @if(!$notification_new) style="display: none" @endif id="markAllNotification" class="btn default blue-stripe"> Отметить все прочитанными </div>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 300px;" data-handle-color="#637283" id="notification-list">
                                @foreach($notifications as $notification)
                                    <li @if($notification->status == 0) class="new" @endif data-id="{{$notification->id}}">
                                        <a href="javascript:;">
                                            <span class="time">
                                                <script>
                                                    d = new Date('{{$notification->created_at}}');
                                                    date = d.getDate();
                                                    month = d.getMonth() + 1;
                                                    year = d.getFullYear();
                                                    document.write(date + "/" + month + "/" + year);
                                                </script>
                                            </span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i>{{$notification->name}}</i>
                                                </span>
                                            </span>
                                            <div>
                                                {{$notification->text}}
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="{{ config('mpouspehm.user_default_img') }}"/>
					<span class="username username-hide-on-mobile">{{Auth::user()->name}}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li @if(Request::is(config('mpouspehm.panel_url')  . "/personal")) class="active" @endif>
                            <a href="/{{ config('mpouspehm.panel_url') }}/personal">
                                <i class="icon-user"></i> @lang('mpouspehm::profile.topmenu.myprofile') </a>
                        </li>
                        <li @if(Request::is(config('mpouspehm.panel_url')  . "/partner")) class="active" @endif>
                            <a href="/{{ config('mpouspehm.panel_url') }}/partner/">
                                <i class="icon-users"></i>@lang('mpouspehm::profile.partnerProgram.title')
                            </a>
                        </li>
                        <li class="divider">
                        </li>

                        <li>
                            <a href="/auth/logout">
                                <i class="icon-key"></i> @lang('mpouspehm::profile.topmenu.logout') </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->

            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
