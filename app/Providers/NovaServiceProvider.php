<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }


    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function resources(): void
    {
        Nova::resources([
            \App\Nova\Order::class,
            \App\Nova\OrderNumber::class,
            \App\Nova\InstallationObject::class,
            \App\Nova\Counterparty::class,
            \App\Nova\OrderType::class,
            \App\Nova\Acceptance::class,
            \App\Nova\User::class,
            \App\Nova\ServiceRequest::class,
            \App\Nova\EquipmentStatus::class,
            \App\Nova\Responsible::class,
            \App\Nova\RejectionReason::class,
            \App\Nova\RequestStatus::class,
            \App\Nova\Otchet::class,
            \App\Nova\Summary::class,
            \App\Nova\LaunchTestSection::class,
        ]);
    }

    protected function routes(): void
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });
    }
}
