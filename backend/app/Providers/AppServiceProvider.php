<?php

namespace App\Providers;

use App\Repositories\AsaasApiRepository;
use App\Repositories\Contracts\ApiRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\CustomerRepositoryEloquent;
use App\Repositories\PaymentRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(ApiRepository::class, AsaasApiRepository::class);
        $this->app->bind(PaymentRepository::class, PaymentRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
