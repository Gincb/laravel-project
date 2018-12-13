<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Service\UserService;
use App\Services\API\ObjectiveService;
use App\Services\API\ProjectService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->app->singleton(UserService::class);
        $this->app->singleton(ProjectService::class);
        $this->app->singleton(ObjectiveService::class);
    }
}
