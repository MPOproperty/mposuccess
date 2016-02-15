<div class="header-navigation pull-right font-transform-inherit">
    <ul>
        <li @if('home' == Route::currentRouteName()) class="active" @endif>
            <a href="/">
                @lang('mpouspehm::front.home')
            </a>
        </li>

        <li class="dropdown @if(Request::is('*success/*')) active @endif">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                @lang('mpouspehm::front.success.title')
            </a>

            <ul class="dropdown-menu">
                <li><a href="/success/structure">@lang('mpouspehm::front.success.consumerStructure')</a></li>
                <li><a href="/success/bonus">@lang('mpouspehm::front.success.bonusProgram')</a></li>
            </ul>
        </li>

        <li @if('news' == Route::currentRouteName() || 'news.post' == Route::currentRouteName()) class="active" @endif>
            <a href="/news">
                @lang('mpouspehm::front.news')
            </a>
        </li>

        <li @if('articles' == Route::currentRouteName() || 'article' == Route::currentRouteName()) class="active" @endif>
            <a href="/articles">
                @lang('mpouspehm::front.article')
            </a>
        </li>

        <li class="dropdown @if(Request::is('*about*')) active @endif">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                @lang('mpouspehm::front.about.title')
            </a>

            <ul class="dropdown-menu">
                <li><a href="/about/contacts">@lang('mpouspehm::front.about.contacts')</a></li>
                <li><a href="/about">@lang('mpouspehm::front.about.title')</a></li>
                <li><a href="/about/rights">@lang('mpouspehm::front.about.rights')</a></li>
                <li class="dropdown-submenu">
                    <a href="javascript:;">@lang('mpouspehm::front.about.docs.title') </a>
                    <ul class="dropdown-menu">
                        <li><a href="/about/charter">@lang('mpouspehm::front.about.docs.charter')</a></li>
                        <li><a href="/about/regdocs">@lang('mpouspehm::front.about.docs.regdocs')</a></li>
                        <li><a href="/about/statement">@lang('mpouspehm::front.about.docs.statement')</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- BEGIN TOP SEARCH -->
        <li class="menu-search">
            <span class="sep"></span>
            <i class="fa fa-search search-btn"></i>
            <div class="search-box">
                <form action="#">
                    <div class="input-group">
                        <input type="text" placeholder="Найти..." class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Найти</button>
                    </span>
                    </div>
                </form>
            </div>
        </li>
        <!-- END TOP SEARCH -->
    </ul>
</div>
