<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Observers\PermissionObserver;
use App\Observers\PermissionRoleObserver;
use App\Observers\RoleObserver;
use App\Observers\RoleUserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Permission::class     => [PermissionObserver::class],
        PermissionRole::class => [PermissionRoleObserver::class],
        Role::class           => [RoleObserver::class],
        RoleUser::class       => [RoleUserObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
