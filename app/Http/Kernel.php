<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin_check'=> \App\Http\Middleware\Admincheck::class,
        'admin_distributor_check'=> \App\Http\Middleware\Admindistributor::class,
        'admin_serviceadmin_check'=> \App\Http\Middleware\Adminserviceadmin::class,
        'admin_servicecenter_check'=> \App\Http\Middleware\Adminservicecenter::class,
        'admin_subdealer_check'=> \App\Http\Middleware\Adminsubdealer::class,
        'admin_hr_check'=> \App\Http\Middleware\Adminhr::class,
        'admin_warehouse_check'=> \App\Http\Middleware\Adminwarehouse::class,
        'admin_warehouse_factory_acc_check'=> \App\Http\Middleware\Adminwarehousefactoryacc::class,
        'admin_directdealer_check'=> \App\Http\Middleware\Admindirectdealer::class,
        'admin_disdea_check'=> \App\Http\Middleware\Admindisdea::class,
        'admin_dissub_check'=> \App\Http\Middleware\Admindissub::class,
        'admin_dirsub_check'=> \App\Http\Middleware\Admindirsub::class,
        'admin_partner_check'=> \App\Http\Middleware\Adminpartner::class,
        'admin_warpartner_check'=> \App\Http\Middleware\Adminwarpartner::class,
        'admin_factory_check'=> \App\Http\Middleware\Adminfactory::class,
        'admin_factory_acc_check'=> \App\Http\Middleware\Adminfactoryacc::class,
        'AATA'=> \App\Http\Middleware\AATA::class,
        'AATB'=> \App\Http\Middleware\AATB::class,
        'admin_accounts_check'=> \App\Http\Middleware\Adminacc::class,
        'admin_enquiry_check'=> \App\Http\Middleware\Adminenquiry::class,
        'admin_waracc_check'=> \App\Http\Middleware\Adminwaracc::class,
        'admin_disacc_check'=> \App\Http\Middleware\Admindisacc::class,
        'admin_hracc_check'=> \App\Http\Middleware\Adminhracc::class,
        'admin_saacc_check'=> \App\Http\Middleware\Adminsaacc::class,
        'admin_scacc_check'=> \App\Http\Middleware\Adminscacc::class,



    ];
}
