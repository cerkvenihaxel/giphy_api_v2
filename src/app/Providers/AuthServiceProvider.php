<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Mockery\Generator\StringManipulation\Pass\Pass;


class AuthServiceProvider extends ServiceProvider
{

    public function boot():void
    {
        $this->registerPolicies();
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
    }
}
