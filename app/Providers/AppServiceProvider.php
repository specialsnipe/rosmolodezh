<?php

namespace App\Providers;

use App\Helpers\Telegram;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Telegram::class, function($app) {
            return new Telegram(new Http(), config('bots.bot'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('ru_RU');
        Paginator::useBootstrapFive();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Подтверждение email')
                ->line('Нажмите на кнопку ниже чтобы подтвердить почту.')
                ->action('Подтвердить почту', $url, 'success')
                ->line('Если вы не регистрировались на нашем сайте то не нажимайте на кнопку.');
        });
    }
}
