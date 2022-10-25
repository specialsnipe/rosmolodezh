<?php

namespace App\Http\Controllers\Auth;

use App\Events\ReturnForgetPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RestorePassword\SubmitRestorePassword;
use App\Mail\RestoredPasswordShipped;
use App\Models\ChangePassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    /**
     * Показать шаблон входа
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('auth.forget-password.index');
    }
    /**
     * Показать шаблон входа
     *
     * @return Application|Factory|View
     */
    public function changePassword()
    {
        $token = request()->input('token');
        $changePassword = ChangePassword::where('token', $token)->first();
        if(!$changePassword) {
            abort(404);
        }
        $user = $changePassword->user_id;
        $user = User::where('id', $user)->first();
        $canChange = $changePassword->expiration_min > Carbon::now();
        if(!$canChange) {
            session()->flash('broken','Ссылка устарела');
        }
        return view('auth.restore.index', compact('user'));
    }

    /**
     * Залогинить пользователя
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function restore(ForgetPasswordRequest $request): RedirectResponse
    {
        
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        event(new ReturnForgetPassword($user));
        return back()->with([
            'message' => 'Данные для восстановления пароля отправлены на вашу почту'
        ]);
    }

    public function submit(SubmitRestorePassword $request, User $user)
    {
        try{
            $user->update([
                'password'=> Hash::make($request->input('password'))
            ]);
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => 'Что-то пошло не так']);
        }
        ChangePassword::where('user_id', $user->id)->delete();
        session()->flash('message', "Вы успешно обновлили пароль, теперь вы можете <a href='" . route('auth.login')  . "'> войти на стайт </a>");
        return redirect()->route('home');
    }
}
