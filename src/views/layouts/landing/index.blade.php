<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title>Бонусная программа</title>


    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Fonts END -->
    <!-- Global styles BEGIN -->
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
    <!-- Global styles END -->
    <!-- Page level plugin styles BEGIN -->
    <link href="assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <!-- Page level plugin styles END -->
    <!-- Theme styles BEGIN -->
    <link href="assets/global/css/components.css" rel="stylesheet">
    <link href="assets/frontend/onepage/css/style.css" rel="stylesheet">
    <link href="assets/frontend/onepage/css/style-responsive.css" rel="stylesheet">
    <link href="assets/frontend/onepage/css/themes/green.css" rel="stylesheet" id="style-color">
    <link href="assets/frontend/onepage/css/custom.css" rel="stylesheet">
    <!-- Theme styles END -->
</head>

<body>
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-8 col-sm-8 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>+7(495) 255-28-09</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>mpo-uspeh-m@yandex.ru</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-4 col-sm-4 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    @if (Auth::check())
                        <li><a href="/panel">{{Auth::user()->name}}</a></li>
                        <li><a href="/auth/logout">@lang('mposuccess::front.logout')</a></li>
                    @else
                        <li><a href="/auth/login">@lang('mposuccess::front.login')</a></li>
                        <li><a href="/auth/register">@lang('mposuccess::front.register')</a></li>
                    @endif
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>

<!-- Header BEGIN -->
<div class="header header-mobi-ext">
    <div class="container">
        <div class="row">
            <!-- Logo BEGIN -->
            <div class="col-md-2 col-sm-2">
                <a class="site-logo" href="/"><img src="/images/logo-png.png" alt="MPOSUCCESS"></a>
            </div>
            <!-- Logo END -->
            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

            <div class="col-md-10 pull-right">
                <ul class="header-navigation">
                    <li class="current"><a href="#promo-block">Главная</a></li>
                    <li><a href="#about">Успеx и Выгода</a></li>
                    <li><a href="#benefits">Наши преимущества</a></li>
                    <li><a href="#portfolio">Проекты</a></li>
                    <li><a href="#prices">Каталог</a></li>
                    <li><a href="#contact">Контакты</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- Header END -->
<!-- Promo block BEGIN -->
<div class="promo-block" id="promo-block">
    <div class="tp-banner-container">
        <div class="tp-banner" >
            <ul>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
                    <img src="/images/onepages/slider/slide1.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="tp-caption large_text customin customout start"
                         data-x="600"
                         data-hoffset="0"
                         data-y="400"
                         data-voffset="60"
                         data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endspeed="300">
                        <div class="promo-like-text">
                            <p>УСПЕХ  - это Ваши активные действия в достижении своих ЖЕЛАНИЙ!</p>
                        </div>
                    </div>
                    <div class="tp-caption large_bold_white fade"
                         data-x="center"
                         data-y="0"
                         data-voffset="-110"
                         data-speed="300"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">От <span>Желаний</span> - к УСПЕХУ!
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
                    <img src="/images/onepages/slider/slide2.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="tp-caption large_text customin customout start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="400"
                         data-voffset="60"
                         data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endspeed="300">
                        <div class="promo-like"><i class="fa fa-thumbs-up"></i></div>
                        <div class="promo-like-text">
                            <h2>Все мы потребители. </h2>
                            <p> Одни просто потребляют, а другие получают от этого доход!<br></p>
                        </div>
                    </div>
                    <div class="tp-caption large_bold_white fade"
                         data-x="center"
                         data-y="0"
                         data-voffset="-110"
                         data-speed="300"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6"><span>Потребитель - владелец!</span>
                    </div>
                </li>

                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
                    <img src="/images/onepages/slider/slide3.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="tp-caption large_text customin customout start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="center"
                         data-voffset="60"
                         data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endspeed="300">
                        <div class="promo-like"><i class="fa fa-thumbs-up"></i></div>
                        <div class="promo-like-text">
                            <h2> ЖИЛЬЕ доступное КАЖДОМУ!</h2>
                        </div>
                    </div>
                    <div class="tp-caption large_bold_white fade"
                         data-x="center"
                         data-y="center"
                         data-voffset="-120"
                         data-speed="300"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">  Ваш <span>УСПЕХ</span> - квартиры на выбор!
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Promo block END -->
<!-- About block BEGIN -->
<div class="about-block content content-center" id="about">
    <div class="container">
        <h2><strong>УСПЕХ и</strong> ВЫГОДА</h2>
        <h4>
            Сделал ВЫГОДНУЮ покупку в подготовительной программе МПО - поймал "золотую рыбку"!<br>
            Активно участвуя в развитии Общества пришел к УСПЕХУ
        </h4>
        <div class="ab-trio">
            <img src="/images/onepages/succses.png" alt="" class="img-responsive">
            <div class="ab-cirlce ab-cirle-blue">
                <i class="fa fa-shopping-cart"></i>
                <strong>Выгода</strong>
            </div>
            <div class="ab-cirlce ab-cirle-red">
                <i class="fa fa-gift"></i>
                <strong>Бонусы</strong>
            </div>
            <div class="ab-cirlce ab-cirle-green">
                <i class="fa fa-institution"></i>
                <strong>Успех</strong>
            </div>
        </div>
    </div>
</div>
<!-- About block END -->
<!-- Services block BEGIN -->
<div class="services-block content content-center">
    <div class="container">
        <h2>Возмо<strong>жности</strong></h2>
        <h4> МПО "Успех-М" для своих программ предложило выгодные условия участия.</h4>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <a target="_blank" href="http://www.vipaktiv.com/#!blank/fw28e">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                <h3>Потребительская структура</h3>
                <p>Участвуем и Получаем до<br><h4><strong> 800 000 рублей в месяц</strong></h4></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <a target="_blank" href="http://www.vipaktiv.com/#!blank/fw28e">
                    <i class="fa fa-gift"></i>
                </a>
                <h3>СТАРТАП</h3>
                <p> Покупаем от 1600 рублей, <br><h4><strong> зарабатываем по 30т рублей</strong></h4></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <a target="_blank" href="http://www.vipaktiv.com/#!blank/fw28e">
                    <i class="fa fa-signal"></i>
                </a>
                <h3>ПАРТНЁРЫ</h3>
                <p>Активные пайщики получают <br><h4><strong>300 000рублей/цикл</strong></h4></p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <a target="_blank" href="http://www.vipaktiv.com/#!blank/fw28e">
                    <i class="fa fa-suitcase"></i>
                </a>
                <h3>ПРИЗФОНД</h3>
                <p>Распределяется между всеми - <br><h4><strong>Личный Счёт до 10млн рублей</strong></h4></p>
            </div>
        </div>
    </div>
</div>
<!-- Services block END -->
<!-- Message block BEGIN -->
<div class="message-block content content-center valign-center" id="message-block">
    <div class="valign-center-elem">
        <h2>ВМЕСТЕ МЫ МОЖЕМ ВСЕ!<strong>Успех Общества зависит от количества его членов.<br> Для новых участников наши ПРЕИМУЩЕСТВА говорят сами за себя!</strong></h2>
        <em>МПО Успех-М</em>
    </div>
</div>
<!-- Message block END -->
<!-- Choose us block BEGIN -->
<div class="choose-us-block content text-center margin-bottom-40" id="benefits">
    <div class="container">
        <h2>Наши<strong> преимущества</strong></h2>
        <h4>В современном мире множество предложений и надо суметь выбрать наилучшее или самое подходящее для Вас.<br> Почему выбирают нас ?</h4>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                <img src="/images/onepages/choose-us.png" alt="Why to choose us" class="img-responsive">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                <div class="panel-group" id="accordion1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">Одно действие -три ВОЗМОЖНОСТИ</a>
                            </h5>
                        </div>
                        <div id="accordion1_1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul>
                                    <li>Проплачивая от 1600 рублей - выбираешь продукт</li>
                                    <li>Получаешь место в подготовительной программе (где приглашая, зарабатываешь  30 000 -300 000 рублей/цикл
                                        в бонусной программе ЖНК "Ваш ДОМ"  или приобретаешь  квартиру, накопив всего от  30% её стоимости)</li>
                                    <li>В  числе первых становишься участником Потребительской структуры от Яндекса (пользуясь которой, получаешь до 800 000 рублей в месяц)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">Льготные ПРОГРАММЫ  МПО "Успех-М"</a>
                            </h5>
                        </div>
                        <div id="accordion1_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Участник МПО  может пользоваться любыми программами разработанными для ПАЙЩИКОВ, а
                                    МПО постоянно добавляет выгодные возможности, услуги, предложения для улучшения качества жизни ПАЙЩИКОВ.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">Фонд ПООЩРЕНИЯ</a>
                            </h5>
                        </div>
                        <div id="accordion1_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Только участники Программы МПО ЖНК "Ваш ДОМ"получают БЕЗВОЗВРАТНУЮ ссуду из Фонда ПООЩРЕНИЯ.</p>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">БЕСПРОЦЕНТНАЯ ссуда</a>
                            </h5>
                        </div>
                        <div id="accordion1_4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Участник ЖНК "Ваш Дом", накопив определенную сумму получает  БЕСПРОЦЕНТНУЮ ссуду сроком до 10 лет.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">ДИВИДЕНДЫ</a>
                            </h5>
                        </div>
                        <div id="accordion1_5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Учредители ЖНК "Ваш ДОМ" и партнёры статуса VIP получают ежегодные ДИВИДЕНДЫ по результатам работы Жилищного Накопительного Кооператива.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">БОНУСЫ</a>
                            </h5>
                        </div>
                        <div id="accordion1_6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Aктивное участие в развитии и работе  программы ЖНК "Ваш ДОМ" достойно вознаграждается и статусный Партнер получает недвижимость по результатам работы.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Choose us block END -->
<!-- Checkout block BEGIN -->
<div class="checkout-block content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Получи все возможности!<em> </em></h2>
            </div>
            <div class="col-md-2 text-right">
                <a href="/auth/register" target="_blank" class="btn btn-primary">регистрируйся!</a>
            </div>
        </div>
    </div>
</div>
<!-- Checkout block END -->
<!-- Portfolio block BEGIN -->
<div class="portfolio-block content content-center" id="portfolio">
    <div class="container">
        <h2 class="margin-bottom-50">Наши <strong>предложения</strong></h2>
    </div>
    <div class="row">
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/2.jpg" alt="NAME" class="img-responsive">
            <a target="_blank" href="http://www.vipaktiv.com/#!blank/fw28e" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Путь к успеxу</strong>
                    <em></em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/6.jpg" alt="NAME" class="img-responsive">
            <a target="_blank" href="http://www.vashdom.org/" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Программа </strong>
                    <em>"Живи и плати"</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/8.jpg" alt="NAME" class="img-responsive">
            <a target="_blank" href="http://www.vashdom.org/" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Программа</strong>
                    <em>"Доступный дом"</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/3.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/news" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Кредит </strong>
                    <em>под залог недвижимости</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/5.jpg" alt="NAME" class="img-responsive">
            <a target="_blank" href="http://www.vashdom.org/" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Квартира </strong>
                    <em>за 50%  от стоимости</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/4.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/news" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Автомобиль за 70%</strong>
                    <em></em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/1.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/success/structure" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Потребительская структура</strong>
                    <em></em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/10.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/articles" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Квартиры от застройщика</strong>
                    <em></em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/7.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/articles" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Банкротство</strong>
                    <em>свобода  от долгов</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/9.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/articles" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Покупка</strong>
                    <em>Готового Бизнеса</em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/12.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/articles" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Твоя защита</strong>
                    <em></em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
        <div class="item col-md-2 col-sm-6 col-xs-12">
            <img src="/images/onepages/portfolio/11.jpg" alt="NAME" class="img-responsive">
            <a href="http://{{ config('mposuccess.site_host') }}/news" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Абонемент </strong>
                    <em>на юридические услуги </em>
                    <b>Подробнее</b>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Portfolio block END -->

<!-- Checkout block BEGIN -->
<div class="checkout-block content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Вступи в МПО - <em>Получи больше возможностей для СЕБЯ!</em></h2>
            </div>
            <div class="col-md-2 text-right">
                <a href="/auth/register" target="_blank" class="btn btn-primary">Присоединяйся!</a>
            </div>
        </div>
    </div>
</div>
<!-- Checkout block END -->
<!-- Prices block BEGIN -->
<div class="prices-block content content-center" id="prices">
    <div class="container">
        <h2 class="margin-bottom-50"><strong>Ката</strong>лог</h2>
        <div class="row">
            <!-- Pricing item BEGIN -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing-item">
                    <div class="pricing-head">
                        <h4>ДИГИДРОКВЕРЦЕТИН</h4>
                    </div>
                    <div class="pricing-content">
                        <div class="pi-price">
                            <strong><em>4800</em><i class='fa  fa-rub'></i></strong>
                            <p>комплект</p>
                        </div>
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a class="btn btn-default" href="/auth/register/">ОПЛАТИТЬ</a>
                    </div>
                </div>
            </div>
            <!-- Pricing item END -->
            <!-- Pricing item BEGIN -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing-item">
                    <div class="pricing-head">
                        <h4>крем "ЗЛАТОСПАС"</h4>
                    </div>
                    <div class="pricing-content">
                        <div class="pi-price">
                            <strong><em>2000</em><i class='fa  fa-rub'></i></strong>
                            <p>упаковка</p>
                        </div>
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a class="btn btn-default" href="/auth/register/">ОПЛАТИТЬ</a>
                    </div>
                </div>
            </div>
            <!-- Pricing item END -->
            <!-- Pricing item BEGIN -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing-item">
                    <div class="pricing-head">
                        <h4>Корректирующее бельё</h4>
                    </div>
                    <div class="pricing-content">
                        <div class="pi-price">
                            <strong><em>1600</em><i class='fa  fa-rub'></i></strong>
                            <p>упаковка</p>
                        </div>
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a class="btn btn-default" href="/auth/register/">ОПЛАТИТЬ</a>
                    </div>
                </div>
            </div>
            <!-- Pricing item END -->
            <!-- Pricing item BEGIN -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="pricing-item">
                    <div class="pricing-head">
                        <h4>АПК Biorithm</h4>
                    </div>
                    <div class="pricing-content">
                        <div class="pi-price">
                            <strong><em>9300</em><i class='fa  fa-rub'></i></strong>
                            <p>комплект</p>
                        </div>
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a class="btn btn-default" href="/auth/register/">ОПЛАТИТЬ</a>
                    </div>
                </div>
            </div>
            <!-- Pricing item END -->
        </div>
    </div>
</div>
<!-- Prices block END -->
<!-- Facts block BEGIN -->
<div class="facts-block content content-center" id="facts-block">
    <h2>НЕКОТОРЫЕ ФАКТЫ О НАС</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>15</strong>
                    Реализуемые проекты
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>7</strong>
                    Команд участников
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>9</strong>
                    Наименований продукта
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>50</strong>
                    Участников еженедельно
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts block END -->
<!-- Testimonials block BEGIN -->
<div class="testimonials-block content content-center margin-bottom-65">
    <div class="container">
        <h2>Отзывы <strong>пользователей</strong></h2>
        <h4></h4>
        <div class="carousel slide" data-ride="carousel" id="testimonials-block">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <!-- Carousel items -->
                <div class="active item">
                    <blockquote>
                        <p>
                            Искала информацию о препаратах и продуктах,
                            нормализующих кровоток в организме человека (30+ как никак…).
                            В последнее время стала замечать повышенную утомляемость, усталость,
                            сплю на ходу и на работе, и дома. Знакомая рекомендовала купить продукт в
                            МПО «Успех-М», благо вариант перспективный. Вот и приобрела биодобавку
                            Дигидроквертицин, плюс с добавками Селена (необходимого микроэлемента)
                            да еще усиленный экстрактом виноградных косточек. Через неделю опять себя чувствовала на 25…,
                            а возможности Общества меня воодушевили на действия. Когда есть силы можно достичь желаемых результатов.
                        </p>
                    </blockquote>
                    <span class="testimonials-name">Ольга 12 сентября 2015 года</span>
                </div>
                <!-- Carousel items -->
                <div class="item">
                    <blockquote>
                        <p>
                            Подруга посоветовала купить это белье с антицеллюлитным эффектом.
                            Эффект достигается благодаря реализации сразу трех полезных воздействий:
                            за счет уникальной текстуры, использующей волны трех разных размеров,
                            благодаря широкой резинке в поясе и V- образной усиленной вязке в области
                            живота достигается максимальный массажный эффект и экстрактами красного перца,
                            ромашки и вытяжки из печени глубоководных рыб, которые встроены в нити белья.
                            Эти элементы усиливают кровообращение в месте соприкосновения ткани и кожи и тем
                            самым помогают улучшить подкожный дренаж.
                            Помимо этого белье оказывает утягивающий эффект,
                            помогая скрыть недостатки фигуры, формирует красивый
                            силуэт и способствует уменьшению жировых отложений.
                            Я полностью довольна полученным эффектом, а возможности Общества,
                            предоставляемые своим партнерам меня также очень заинтересовали. Рекомендую их всем своим знакомым.
                        </p>
                    </blockquote>
                    <span class="testimonials-name">Наталья 27 сентября 2015 года</span>
                </div>
                <!-- Carousel items -->
                <div class="item">
                    <blockquote>
                        <p>
                            На фоне стресса обострилась болезнь варикозное расширение вен, стали очень болеть ноги и тянуть вены,
                            не могла ходить на низком каблуке, а о высоком забыла. Знакомая рекомендовала приобрести крем в МПО «Успех-М».
                            Через 4 дня применения крема « ЗЛАТОСПАС» боли все исчезли, через 10 дней встала снова на каблуки. Так же наносила крем «ЗЛАТОСПАС» на лицо,
                            шею и руки - виден омолаживающий эффект, кожа стала на лице красивой, гладкой и начал подтягиваться овал лица,
                            мимические мелкие морщинки стали менее заметны.
                            Чувствую себя великолепно, а активно участвуя в развитии Общества,
                            рекомендуя своим знакомым возможности для здоровья и жизни, предлагаемые всем участникам,
                            получила еще и финансовый результат. Чем также очень довольна, чего и всем желаю.
                        </p>
                    </blockquote>
                    <span class="testimonials-name">Светлана 10 октября 2015 года</span>
                </div>
            </div>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#testimonials-block" data-slide-to="0" class="active"></li>
                <li data-target="#testimonials-block" data-slide-to="1"></li>
                <li data-target="#testimonials-block" data-slide-to="2"></li>
            </ol>
        </div>
    </div>
</div>
<!-- Testimonials block END -->
<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer" id="contact">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>О нас</h2>
                <p>ПРОГРАММА Жилищный накопительный кооператив "Наш ДОМ"
                    СУПЕРЭФФЕКТ 3 в 1:
                    <ul>
                        <li>- Вам нужна квартира</li>
                        <li>- Вас интересует возможность заработка</li>
                        <li>- Вы хотите получать пассивный доход</li>
                    </ul>
                    Все это есть в наших предложениях.
                </p>
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-3 col-sm-6 pre-footer-col">
                <h2>Наши контакты</h2>
                <address class="margin-bottom-40">
                    Электродная улица, 4Б,офис 107<br>
                    Москва, Россия<br>
                    Телефон: +7 (985) 267 04 04<br>
                    Телефон: +7(495) 255-28-09<br>
                    Email: <a href="mailto:info@mposuccess.ru">info@mposuccess.ru</a><br>
                    Skype: <a href="skype:mposuccess">mposuccess</a>
                </address>
            </div>
            <!-- END BOTTOM CONTACTS -->

            <!-- BEGIN TWITTER BLOCK -->
            <div class="col-md-5 col-sm-12 pre-footer-col">
                <div class="pre-footer-subscribe-box pre-footer-subscribe-box-vertical">
                    <h2>Подписка</h2>
                    <p>Подпишитесь на нашу рассылку и будьте в курсе последних новостей и специальных предложений!</p>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" placeholder="youremail@mail.com" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Подписаться</button>
                  </span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END TWITTER BLOCK -->
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-6 col-sm-6 padding-top-10">
                2015 © МПО "Успех-М" <a href="javascript:;">Все права защещины</a> | <a href="javascript:;">Условия использования</a>
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN PAYMENTS -->
            <div class="col-md-6 col-sm-6">
                <ul class="social-footer list-unstyled list-inline pull-right">
                    <li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-skype"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-vk"></i></a></li>

                </ul>
            </div>
            <!-- END PAYMENTS -->
        </div>
    </div>
</div>
<!-- END FOOTER -->
<a href="#promo-block" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<![endif]-->
<!-- Load JavaScripts at the bottom, because it will reduce page load time -->
<!-- Core plugins BEGIN (For ALL pages) -->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Core plugins END (For ALL pages) -->
<!-- BEGIN RevolutionSlider -->
<script src="assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="assets/frontend/onepage/scripts/revo-ini.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->
<!-- Core plugins BEGIN (required only for current page) -->
<script src="assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="assets/global/plugins/jquery.easing.js"></script>
<script src="assets/global/plugins/jquery.parallax.js"></script>
<script src="assets/global/plugins/jquery.scrollTo.min.js"></script>
<script src="assets/frontend/onepage/scripts/jquery.nav.js"></script>
<!-- Core plugins END (required only for current page) -->
<!-- Global js BEGIN -->
<script src="assets/frontend/onepage/scripts/layout.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        Layout.init();
    });
</script>
<!-- Global js END -->
</body>
</html>
