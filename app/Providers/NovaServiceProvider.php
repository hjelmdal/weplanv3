<?php

namespace App\Providers;

use App\Models\BadmintonPeople\BpClub;
use App\Models\BadmintonPeople\BpPlayer;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use Eminiarts\NovaPermissions\NovaPermissions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    protected function routes()
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
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                "stephan@pixel8.dk",
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */


    public function tools()
    {
        return [
            // ...
            new \Eminiarts\NovaPermissions\NovaPermissions(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function resources()
    {
        Nova::resourcesIn(app_path('Nova'));

        Nova::resources([\Eminiarts\NovaPermissions\Nova\Permission::class,
            \Eminiarts\NovaPermissions\Nova\Role::class]);


    }
}
