<h3 class="page-title">
    {{ $time }}, {{ $user->name }} {{ $user->patronymic }}
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $myPersonalChilds }}
                </div>
                <div class="desc">
                    Лично приглашённые
                </div>
            </div>
            <a class="more" href="panel/tree">
               Подробнее <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $profit }} <i class='fa  fa-rub'></i>
                </div>
                <div class="desc">
                    Полученный доxод
                </div>
            </div>
            <a class="more" href="http://mposuccess.tk/panel/score/bonuses">
               Подробнее <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $transactions }}
                </div>
                <div class="desc">
                    Мои покупки
                </div>
            </div>
            <a class="more" href="panel/score/purchases">
               Подробнее <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    {{ $myChilds }}
                </div>
                <div class="desc">
                    Моя команда
                </div>
            </div>
            <a class="more" href="javascript:;">
                Подробнее <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
    <div class="tile double-down selected withdrawal" data-toggle="modal" data-target="#withdrawal">
        <div class="corner">
        </div>
        <div class="check">
        </div>
        <div class="tile-body" style="text-align: center">
            <h3 style="color: #fff;padding:10px;">Реферальная ссылка:
                <a style="text-decoration: none;overflow: hidden;color:#fff;" href="/auth/register/{{ $user->sid }}">{{ url('') . config('mposuccess.register_url') . $user->sid }}</a>
            </h3>
        </div>
    </div>
