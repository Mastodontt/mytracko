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
        Paginator::useBootstrap();

        Blade::directive('canEdit', function ($post) {
            return "<?php if (auth()->check() && {$post}->created_by === auth()->user()->id): ?>";
        });
    
        Blade::directive('endcanEdit', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('canLike', function ($createdBy) {
            return "<?php if (auth()->check() && $createdBy !== auth()->user()->id): ?>";
        });
    
        Blade::directive('endCanLike', function () {
            return "<?php endif; ?>";
        });
    }
}
