<meta charset="utf-8"/>
<title>{{ $title or config('mposuccess.default_title')}}: {{ config('mposuccess.company_title') }}</title>
<link rel="icon" type="image/png" href="/images/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="_token" content="{{ csrf_token() }}"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES-->
<link href="/assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/assets/layout/admin/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="/assets/layout/admin/css/themes/light2.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap-toastr/toastr.min.css">

<link href="/assets/css/operations.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/main.css" rel="stylesheet" type="text/css"/>
<link href='https://fonts.googleapis.com/css?family=Russo+One&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
{!! \Assets::css() !!}
<!-- END THEME STYLES -->
