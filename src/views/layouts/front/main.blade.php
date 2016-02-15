<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<!--<![endif]-->
<!-- BEGIN HEAD -->
    <head>
        @include('mpouspehm::layouts.front.head')
    </head>

    <body class="corporate">

        <header>
            @include('mpouspehm::layouts.front.top')
            @include('mpouspehm::layouts.front.header')
        </header>

        {!! $slider !!}

        <!-- BEGIN CONTAINER -->
        <div class="main">
            <div class="container">
                {!! $content !!}
            </div>
        </div>

        <!-- END CONTAINER -->
        @include('mpouspehm::layouts.front.prefooter')
        @include('mpouspehm::layouts.front.footer')
        @include('mpouspehm::layouts.front.script')
    </body>
<!-- END BODY -->
</html>