<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.locale') === 'sk') {
            setlocale(LC_ALL, 'sk_SK.UTF-8');
        }
        
        Paginator::useBootstrap();

        Blade::directive('date_localized', function ($expression) {
            return "<?php echo ($expression)->formatLocalized(config('settings.date_format')); ?>";
        });

        Blade::directive('money', function ($money) {
            return "<?php echo number_format($money, 0, ',', ' ') . ' ' . config('settings.currency'); ?>";
        });
    }
}
