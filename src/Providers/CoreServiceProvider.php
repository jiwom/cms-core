<?php

namespace Yajra\CMS\Providers;

use Arrilot\Widgets\ServiceProvider as ArrilotWidgetServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugbarServiceProvider;
use Barryvdh\Snappy\ServiceProvider as SnappyServiceProvider;
use Baum\Providers\BaumServiceProvider;
use Caffeinated\Menus\MenusServiceProvider;
use Conner\Tagging\Providers\TaggingServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laracasts\Flash\FlashServiceProvider;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider;
use Spatie\Backup\BackupServiceProvider;
use Spatie\Fractal\FractalServiceProvider;
use Yajra\Acl\AclServiceProvider;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsServiceProvider;
use Yajra\CMS\Contracts\SearchEngine;
use Yajra\CMS\Search\Engines\LocalSearch;
use Yajra\CMS\Themes\ThemesServiceProvider;
use Yajra\CMS\View\Directives\PageHeaderDirective;
use Yajra\CMS\View\Directives\TooltipDirective;
use Yajra\DataTables\ButtonsServiceProvider;
use Yajra\DataTables\DataTablesServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCustomValidations();
        $this->bootCustomBladeDirectives();
        $this->registerViews();
        $this->bootTranslations();
        $this->bootDebugbar();
    }

    /**
     * Boot custom app validations.
     */
    protected function bootCustomValidations()
    {
        $this->app['validator']->extend('view_exists', function ($attribute, $value, $parameters, $validator) {
            return view()->exists($value);
        });

        $this->app['validator']->extend('slug', function ($attribute, $value) {
            return preg_match('/^[\pL\.\-\_\d+]+$/u', $value);
        });

        $this->app['validator']->extend('json', function ($attribute, $value, $parameters, $validator) {
            json_decode($value);

            return (json_last_error() == JSON_ERROR_NONE);
        });
    }

    /**
     * Boot custom blade directives.
     */
    protected function bootCustomBladeDirectives()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->app['blade.compiler'];
        $blade->directive('tooltip', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\TooltipDirective')->handle({$expression}); ?>";
        });

        $blade->directive('pageHeader', function ($expression) {
            return "<?php echo app('Yajra\\CMS\\View\\Directives\\PageHeaderDirective')->handle({$expression}); ?>";
        });
    }

    /**
     * Register cms-core view path.
     */
    protected function registerViews()
    {
        /** @var \Illuminate\View\Factory $view */
        $view = $this->app['view'];
        $view->addLocation(__DIR__ . '/../resources/views');
    }

    /**
     * Boot and publish translations.
     */
    protected function bootTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/cms'),
        ], 'cms-core');
    }

    /**
     * Boot debugbar package.
     */
    protected function bootDebugbar()
    {
        if (config('app.debug') && config('app.debugbar')) {
            $this->app->registerDeferredProvider(DebugbarServiceProvider::class);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
        $this->registerBindings();
        $this->registerAliases();
        $this->registerMigrations();
    }

    /**
     * Registered required administrator providers.
     */
    protected function registerProviders()
    {
        $this->app->register(ConfigurationServiceProvider::class);
        $this->app->register(ThemesServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ViewComposerServiceProvider::class);
        $this->app->register(AclServiceProvider::class);
        $this->app->register(MenusServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
        $this->app->register(FlashServiceProvider::class);
        $this->app->register(FractalServiceProvider::class);
        $this->app->register(SnappyServiceProvider::class);
        $this->app->register(BaumServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(BackupServiceProvider::class);
        $this->app->register(FormServiceProvider::class);
        $this->app->register(LaravelLogViewerServiceProvider::class);
        $this->app->register(ArrilotWidgetServiceProvider::class);
        $this->app->register(WidgetServiceProvider::class);
        $this->app->register(DataTablesServiceProvider::class);
        $this->app->register(ButtonsServiceProvider::class);
        $this->app->register(TaggingServiceProvider::class);
    }

    /**
     * Register IOC bindings.
     */
    protected function registerBindings()
    {
        $this->app->singleton(PageHeaderDirective::class, PageHeaderDirective::class);
        $this->app->singleton(TooltipDirective::class, TooltipDirective::class);
        $this->app->singleton(SearchEngine::class, LocalSearch::class);
    }

    /**
     * Register application aliases.
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Breadcrumbs', \DaveJamesMiller\Breadcrumbs\Facade::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Excel', \Maatwebsite\Excel\Facades\Excel::class);
        $loader->alias('PDF', \Barryvdh\Snappy\Facades\SnappyPdf::class);
        $loader->alias('Image', \Barryvdh\Snappy\Facades\SnappyImage::class);
        $loader->alias('Widget', \Arrilot\Widgets\Facade::class);
        $loader->alias('AsyncWidget', \Arrilot\Widgets\AsyncFacade::class);
        $loader->alias('Module', \Pingpong\Modules\Facades\Module::class);
    }

    /**
     * Register core migration files.
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
    }
}
