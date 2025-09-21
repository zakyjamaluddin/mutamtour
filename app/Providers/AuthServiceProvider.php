<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Jamaah;
use App\Models\Group;
use App\Models\Kantor;
use App\Models\Paket;
use App\Models\Pembayaran;
use App\Models\Role;
use App\Policies\JamaahPolicy;
use App\Policies\UserPolicy;
use App\Policies\GroupPolicy;
use App\Policies\KantorPolicy;
use App\Policies\PaketPolicy;
use App\Policies\PembayaranPolicy;
use App\Policies\RolePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Jamaah::class => JamaahPolicy::class,
        Group::class => GroupPolicy::class,
        Kantor::class => KantorPolicy::class,
        Paket::class => PaketPolicy::class,
        Pembayaran::class => PembayaranPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates if needed
        Gate::define('manage-users', function (User $user) {
            return $user->hasRole(['super_admin', 'admin']);
        });

        Gate::define('manage-jamaah', function (User $user) {
            return $user->hasRole(['super_admin', 'admin', 'cs']);
        });

        Gate::define('view-only', function (User $user) {
            return $user->hasRole(['viewer']);
        });
    }
}
