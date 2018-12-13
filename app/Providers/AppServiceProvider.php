<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Repositories\MemberRepository;
use App\Repositories\ObjectiveRepository;
use App\Repositories\PlanRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
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
        $this->registerRepositories();
    }

    /**
     *
     */
    private function registerServices(): void
    {
        $this->app->singleton(UserService::class);
        $this->app->singleton(ProjectService::class);
        $this->app->singleton(ObjectiveService::class);
    }

    /**
     *
     */
    private function registerRepositories(): void
    {
        $this->app->singleton(ProjectRepository::class);
        $this->app->singleton(ObjectiveRepository::class);
        $this->app->singleton(PlanRepository::class);
        $this->app->singleton(TeamRepository::class);
        $this->app->singleton(MemberRepository::class);
        $this->app->singleton(UserRepository::class);
    }
}
