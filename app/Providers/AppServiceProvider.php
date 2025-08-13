<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\DeductProductQuantity;
use App\Listeners\EmptyCart;
use App\Listeners\SendOrderCreatedNotification;
use App\Services\CurrencyConverter;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(
                config('services.currency_converter.api_key'),
            );
        });
        $this->app->bind('abilities', function () {
            return include base_path('data/abilities.php');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Paginator::useBootstrapFive();

        Event::listen(SendEmailVerificationNotification::class);
        Event::listen(OrderCreated::class, DeductProductQuantity::class);
        Event::listen(OrderCreated::class, SendOrderCreatedNotification::class);
        // Event::listen(OrderCreated::class, EmptyCart::class);

        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }
        });

        foreach ($this->app->make('abilities') as $ability_code => $ability_name) {
            Gate::define("{$ability_code}", function ($user) use ($ability_code) {
                return $user->hasAbility($ability_code);
            });
        }
    }
}
