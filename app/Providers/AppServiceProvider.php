<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\StateRepository;
use App\Repositories\UserRepository;
use App\Services\AddressService;
use App\Services\CityService;
use App\Services\Contracts\AddressServiceInterface;
use App\Services\Contracts\CityServiceInterface;
use App\Services\Contracts\StateServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\StateService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AddressServiceInterface::class, AddressService::class);
        $this->app->bind(StateServiceInterface::class, StateService::class);
        $this->app->bind(CityServiceInterface::class, CityService::class);
    }
}
