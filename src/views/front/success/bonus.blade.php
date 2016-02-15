<div class="row">
    <div class="col-md-12 blog-page">
        <div class="portlet light">
            <div class="portlet-title tabbable-line">
                <div class="caption caption-md">
                    <i class="icon-globe theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">@lang('mpouspehm::front.marketingOut.bonusProgram')</span>
                </div>
                <ul class="nav nav-tabs">
                    <li @if (!in_array(Session::get('tab'), [2])) class="active" @endif>
                        <a href="#tab_1_1" data-toggle="tab">@lang('mpouspehm::front.marketingOut.startUp')</a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <!-- yourProtection TAB -->
                    <div class="tab-pane @if (!in_array(Session::get('tab'), [2])) active @endif" id="tab_1_1">
                        <div class="row">
                            <div class="col-md-12 article-block">
                                <h3>«Стартап»</h3>
                                <div class="blog-tag-data col-md-4">
                                    <img src="/images/home/works/9.png" class="img-responsive" alt="">
                                </div>
                                <!--end news-tag-data-->
                                <div>

                                    <p>
                                        <b>Бонусная программа</b> - Программа учета членов Общества с распределением по
                                        структуре вознаграждений за активное участие в развитии Общества путем приглашения
                                        к участию в нем новых членов. Таким образом создается сеть активных участников
                                        МПО, которая позволяет получать соответствующие бонусы.
                                    </p>

                                    <p>
                                        <b>Регистрация</b> - производится одновременно в Подготовительную программу
                                        по бинару и Потребительскую структуру от Яндекса.
                                    </p>
                                    <blockquote class="hero col-md-8">
                                        <p>
                                            <b>Бонус</b> - выплачивается за лично рекомендованных, за выполнение 1-го
                                            этапа, за выполнение стандартного этапа, за каждый цикл и по акции
                                        </p>
                                        <small>Условие получения бонуса от общего прироста структуры -
                                            <cite title="Source Title">3 лично рекомендованных.</cite>
                                        </small>
                                    </blockquote>
                                    <p>
                                        Бинар учетная система, которая строится по принципу:
                                        когда под одно место в программе можно поставить только <b>2</b> новых и т.д.
                                    </p>

                                    <p>
                                        Начисления производятся автоматически на счет в личном кабинете участника ,
                                        откуда бонус переводится через заявку админу, по желанию, на карту или кассу.
                                    </p>
                                    

                                </div>
                            </div>
                            <!--end col-md-12-->
                        </div>
                    </div>
                    <!-- yourProtection TAB -->
                    <hr>
                    <div class="row quote-v1 margin-bottom-30">
                        <div class="col-md-9">
                            <span>Хочешь узнать больше? </span>
                        </div>
                        <div class="col-md-3 text-right">
                            <a class="btn-transparent" href="/auth/register" target="_blank"><i class="fa fa-rocket margin-right-10"></i>ПРИСОЕДИНЯЙСЯ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->
