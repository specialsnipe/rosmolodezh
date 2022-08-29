<?php

namespace App\Providers;



use App\Models\User;
use App\Models\Track;
use App\Models\Answer;
use App\Models\Exercise;
use App\Policies\UserPolicy;
use App\Policies\TrackPolicy;
use App\Policies\AnswerPolicy;
use App\Policies\ExercisePolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Track::class => TrackPolicy::class,
        Answer::class => AnswerPolicy::class,
        Exercise::class => ExercisePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
