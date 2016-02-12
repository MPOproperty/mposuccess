<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="/assets/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/login-soft.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES -->
	<link href="/assets/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/layout/admin/css/layout.css" rel="stylesheet" type="text/css"/>
	<link id="style_color" href="/assets/layout/admin/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/layout/admin/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html" class="logo-default">
		<span>TEACHER</span>
		<span>LOG</span>
		<!--<img src="../..//assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>-->
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="index.html" method="post">
		<h3>Забыли пароль ?</h3>
		<p>
			Введите ваш адрес электронной почты, который был указан при регистрации.
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Назад </button>
			<button type="submit" class="btn blue pull-right">
				Отправить <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	2015 &copy; Mposuccess - Admin.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/plugins/respond.min.js"></script>
<script src="/assets/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/js/metronic.js" type="text/javascript"></script>
<script src="/assets/layout/admin/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/js/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Login.init();
		// init background slide images
		$.backstretch([
					"/assets/img/bg/1.jpg",
					"/assets/img/bg/2.jpg",
					"/assets/img/bg/3.jpg",
					"/assets/img/bg/4.jpg"
				], {
					fade: 1000,
					duration: 8000
				}
		);
	});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>