<?php namespace MPOproperty\Mpouspehm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use MPOproperty\Mpouspehm\Event\TreeEventHandler;
use Event;


class MpouspehmServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot(Request $request)
	{
		$subscriber = new TreeEventHandler();
		Event::subscribe($subscriber);

		$this->loadTranslationsFrom(__DIR__.'/../../lang', 'mpouspehm');

		$this->loadViewsFrom(__DIR__.'/../../views/', 'mpouspehm');

		$this->publishes([
			__DIR__.'/../../views/errors' => base_path('resources/views/errors'),
		], 'errors');

		/*$this->publishes([
			__DIR__.'/../../views/auth' => base_path('resources/views/auth'),
		], 'auth');*/

		$this->publishes([
			__DIR__.'/../../../public/images' => base_path('public/images'),
		], 'images');

		/*$this->publishes([
			__DIR__.'/../../../public/assets' => base_path('public/assets'),
		], 'assets');*/

		/*$this->publishes([
			__DIR__.'/../../config/mpouspehm.php' => config_path('mpouspehm.php'),
		], 'config');*/

		$this->publishes([
			__DIR__ . '/../../lang/ru/validation.php' => base_path('/resources/lang/ru/validation.php')
		], 'lang');

		$this->publishes([
			__DIR__ . '/../../migrations/' => base_path('/database/migrations')
		], 'migrations');

		$this->publishes([
			__DIR__ . '/../../seeds/' => base_path('/database/seeds')
		], 'seeds');

		/*$this->publishes([
			__DIR__.'/../../../public/' => public_path(),
		], 'public');*/

		include __DIR__.'/../../routes.php';

		/**
		 * TODO redirect to current page
		 */
		if(file_exists(config_path('administrator.php'))){
			unlink(config_path('administrator.php'));
			return Redirect::to($request->url());
		}
		if(file_exists(config_path('roles.php'))){
			unlink(config_path('roles.php'));
			return Redirect::to($request->url());
		}

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{


		$this->mergeConfigFrom(
			__DIR__.'/../../config/administrator.php', 'administrator'
		);

		$this->mergeConfigFrom(
			__DIR__.'/../../config/roles.php', 'roles'
		);

		$this->mergeConfigFrom(
			__DIR__.'/../../config/mpouspehm.php', 'mpouspehm'
		);

		$this->mergeConfigFrom(
			__DIR__.'/../../config/assets.php', 'assets'
		);

		$this->mergeConfigFrom(
			__DIR__.'/../../config/welletone.php', 'welletone'
		);

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
