<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::registerView(function () {
        return view('auth.register');
    });

        Fortify::loginView(function () {
        return view('auth.login');
    });

        Fortify::verifyEmailView(function () {
        return view('auth.verify-email');
    });
        Fortify::redirects('register', '/email/verify');

        RateLimiter::for('login', function (Request $request) {
         $email = (string) $request->email;

         return Limit::perMinute(10)->by($email . $request->ip());
    });
    
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);

       Fortify::authenticateUsing(function (Request $request) {
        
       Validator::make($request->all(), [
        'email' => ['required'],
        'password' => ['required'],
    ], [
        'email.required' => 'メールアドレスを入力してください',
        'password.required' => 'パスワードを入力してください',
    ])->validate();

       $user = User::where('email', $request->email)->first();


       if (!$user || !Hash::check($request->password, $user->password)) {
         throw ValidationException::withMessages([
            'email' => ['ログイン情報が登録されていません'],
          ]);
    }
       if (
           !$user->hasVerifiedEmail() &&
           !session()->has('verification-mail-sent')
         )  {
           $user->sendEmailVerificationNotification();

           session(['verification-mail-sent' => true]);
        }
       
      return $user;
});
    }
}