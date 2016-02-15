<?php

/*
|---------------------------------------------------------------------------
| Here are SOME of the available configuration options with suitable values.
| Uncomment and customize those you want to override or remove them to
| use their default values. For a FULL list of options please visit
| https://github.com/Stolz/Assets/blob/master/API.md#assets
|---------------------------------------------------------------------------
*/

return array(

	/**
	 * Regex to match against a filename/url to determine if it is an asset.
	 *
	 * @var string
	 */
	//'asset_regex' => '/.\.(css|js)$/i',

	/**
	 * Regex to match against a filename/url to determine if it is a CSS asset.
	 *
	 * @var string
	 */
	//'css_regex' => '/.\.css$/i',

	/**
	 * Regex to match against a filename/url to determine if it is a JavaScript asset.
	 *
	 * @var string
	 */
	//'js_regex' => '/.\.js$/i',

	/**
	 * Absolute path to the public directory of your App (WEBROOT).
	 * Required if you enable the pipeline.
	 * No trailing slash!.
	 *
	 * @var string
	 */
	//'public_dir' => (function_exists('public_path')) ? public_path() : '/var/www/localhost/htdocs',

	/**
	 * Directory for local CSS assets.
	 * Relative to your public directory ('public_dir').
	 * No trailing slash!.
	 *
	 * @var string
	 */
	'css_dir' => '/assets',

	/**
	 * Directory for local JavaScript assets.
	 * Relative to your public directory ('public_dir').
	 * No trailing slash!.
	 *
	 * @var string
	 */
	'js_dir' => '/assets',

	/**
	 * Directory for local package assets.
	 * Relative to your public directory ('public_dir').
	 * No trailing slash!.
	 *
	 * @var string
	 */
	//'packages_dir' => 'packages',

	/**
	 * Enable assets pipeline (concatenation and minification).
	 * Use a string that evaluates to `true` to provide the salt of the pipeline hash.
	 * Use 'auto' to automatically calculated the salt from your assets last modification time.
	 *
	 * @var bool|string
	 */
	//'pipeline' => false,

	/**
	 * Directory for storing pipelined assets.
	 * Relative to your assets directories ('css_dir' and 'js_dir').
	 * No trailing slash!.
	 *
	 * @var string
	 */
	//'pipeline_dir' => 'min',

	/**
	 * Enable pipelined assets compression with Gzip.
	 * Use only if your webserver supports Gzip HTTP_ACCEPT_ENCODING.
	 * Set to true to use the default compression level.
	 * Set an integer between 0 (no compression) and 9 (maximum compression) to choose compression level.
	 *
	 * @var bool|integer
	 */
	//'pipeline_gzip' => false,

	/**
	 * Closure used by the pipeline to fetch assets.
	 *
	 * Useful when file_get_contents() function is not available in your PHP
	 * instalation or when you want to apply any kind of preprocessing to
	 * your assets before they get pipelined.
	 *
	 * The closure will receive as the only parameter a string with the path/URL of the asset and
	 * it should return the content of the asset file as a string.
	 *
	 * @var Closure
	 */
	//'fetch_command' => function ($asset) {return preprocess(file_get_contents($asset));},

	/**
	 * Available collections.
	 * Each collection is an array of assets.
	 * Collections may also contain other collections.
	 *
	 * @var array
	 */

	'collections' => array(

		'catalog' => array(
			'plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css',
			'plugins/fancybox/source/jquery.fancybox.css',
			'css/style-shop.css',
			'css/pricing-table.css',

			'plugins/fancybox/source/jquery.fancybox.pack.js',
			'plugins/bootstrap-touchspin/bootstrap.touchspin.js',
			'plugins/zoom/jquery.zoom.min.js',
			'plugins/bootbox/bootbox.min.js',
			'js/custom/pricing.js',
		),

		'profile' => array(
			'plugins/select2/select2.css',
			'plugins/bootstrap-datepicker/css/datepicker.css',
			'css/profile-old.css',
			'css/profile.css',

			'plugins/select2/select2.min.js',
			'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',
			'plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',
			'plugins/zeroclipboard/ZeroClipboard.js',
			'js/custom/profile.js'
		),

		'profile-other' => array(
			'css/profile-old.css',
			'css/custom/profile-other.css',
		),

		'news-private' => array(
			'css/blog.css',
			'plugins/bootstrap-select/bootstrap-select.min.css',
			'css/custom/news-private.css',

			'plugins/bootstrap-select/bootstrap-select.min.js',
			'js/custom/news-private.js'
		),

		'post' => array(
			'css/blog.css',
			'css/custom/post.css'
		),

		'news-front' => array(
			'css/news.css'
		),

		'news-table' => array(
			'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'css/news-table-managed.css',

			'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'js/table-managed.js',
		),

		'news-form-editable' => array(
			'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css',
			'plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css',
			'plugins/bootstrap-fileinput/bootstrap-fileinput.css',

			'plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js',
			'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js',
			'plugins/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.ru-RU.js',
			'plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js',
			'plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js',
			'plugins/bootstrap-fileinput/bootstrap-fileinput.js',
			'plugins/jquery.mockjax.js',
			'js/form-editable.js',
		),

		'products-table' => array(
			//'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'css/custom/products-table-managed.css',

			//'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'js/custom/products-table-managed.js',
		),

		'product-form-editable' => array(
			//'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css',
			'plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css',
			'plugins/ion.rangeslider/css/ion.rangeSlider.css',
			'plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css',
			'plugins/jquery-multi-select/css/multi-select.css',

			//'plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js',
			//'plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js',
			'plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js',
			'plugins/ion.rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js',
			'plugins/bootstrap-touchspin/bootstrap.touchspin.js',
			'plugins/jquery.mockjax.js',
			'plugins/jquery-multi-select/js/jquery.multi-select.js',
			'js/custom/product-form-editable.js',
		),


		'structures' => array(
			'plugins/select2/select2.css',
			'css/tree.css',

			'plugins/select2/select2.min.js',
			'plugins/D3js/d3.js',
			'plugins/D3js/d3.layout.js',
			'js/tree.js'
		),

		'payment-create' => array(
			'plugins/select2/select2.css',

			'plugins/select2/select2.min.js',
		),

		'tree' => array(
			'plugins/jstree/dist/jstree.min.js',
			'js/custom/tree.js',
			'plugins\jstree\dist\themes\default\style.min.css'
		),

		'admin-users' => array(
			'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'plugins/bootstrap-datepicker/css/datepicker.css',
			'css/components.css',
			'css/custom/admin-users.css',

			'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',

			'plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',

			'js/metronic.js',

			'js/table/datatable.js',
			'js/table/users.js',

			'js/custom/admin-users.js',

		),

		'payments-base' => array(
			'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'plugins/bootstrap-datepicker/css/datepicker.css',
			'css/components.css',
			'css/custom/admin-payments.css',

			'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',

			'plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',

			'js/metronic.js',

			'js/table/datatable.js',
		),

		//Все транзакции для админа
		'admin-payments' => array(
			'js/table/payments.js',
			'js/custom/admin-payments.js',
		),

		//Запросы на вывод средств для админа
		'admin-withdrawal' => array(
			'js/table/withdrawal.js',
			'js/custom/admin-withdrawal.js',
		),

		//бонусы пользователя
 		'my-bonuses' => array(
			'js/table/user-payments.js',
			'js/custom/profile-bonus.js',
		),

		//операции пользователя
		'my-operations' => array(
			'js/table/payments.js',
			'js/custom/profile-my-operations.js',
		),

		//покупки пользователя
		'profile-payments' => array(
			'js/table/user-payments.js',
			'js/custom/profile-payments.js',
		),

		'profile-operations' => [
			'js/custom/profile-operations.js',
		],

		'panel-notifications' => array(
			'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'plugins/bootstrap-datepicker/css/datepicker.css',
			'css/components.css',
			'css/custom/panel-notifications.css',

			'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',

			'js/metronic.js',

			'js/table/datatable.js',
			'js/table/notifications.js',

			'js/custom/panel-notifications.js',
		),

		'admin-entities' => array(
			'plugins/select2/select2.css',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
			'plugins/bootstrap-datepicker/css/datepicker.css',
			'plugins/bootstrap-fileinput/bootstrap-fileinput.css',
			'css/components.css',
			'css/custom/admin-entities.css',

			'plugins/select2/select2.min.js',
			'plugins/datatables/media/js/jquery.dataTables.min.js',
			'plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
			'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
			'plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',

			'plugins/bootstrap-fileinput/bootstrap-fileinput.js',

			'js/metronic.js',

			'js/table/datatable.js',
			'js/table/entities.js',

			'js/custom/admin-entities.js',
		),


		/*// jQuery (CDN)
		'jquery-cdn' => array('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'),

		// jQuery UI (CDN)
		'jquery-ui-cdn' => array(
			'jquery-cdn',
			'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
		),

		// Twitter Bootstrap (CDN)
		'bootstrap-cdn' => array(
			'jquery-cdn',
			'//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css',
			'//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css',
			'//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
		),

		// Zurb Foundation (CDN)
		'foundation-cdn' => array(
			'jquery-cdn',
			'//cdn.jsdelivr.net/foundation/5.3.3/css/normalize.css',
			'//cdn.jsdelivr.net/foundation/5.3.3/css/foundation.min.css',
			'//cdn.jsdelivr.net/foundation/5.3.3/js/foundation.min.js',
			'app.js'
		),*/

	),

	/**
	 * Preload assets.
	 * Here you may set which assets (CSS files, JavaScript files or collections)
	 * should be loaded by default even if you don't explicitly add them on run time.
	 *
	 * @var array
	 */
	//'autoload' => array('jquery-cdn'),

);
