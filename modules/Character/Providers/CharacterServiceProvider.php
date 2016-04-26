<?php namespace Modules\Character\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class CharacterServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Boot the application events.
     *
     * @param GateContract $gate
     */
	public function boot(GateContract $gate)
	{
		$this->registerTranslations();
		$this->registerConfig();
		$this->registerViews();

        //$gate->define('');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{		
		//
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('character.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'character'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('resources/views/modules/character');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom(array_merge(array_map(function ($path) {
			return $path . '/modules/character';
		}, \Config::get('view.paths')), [$sourcePath]), 'character');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/character');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'character');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'character');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
