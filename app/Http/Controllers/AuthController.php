<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Redirect;
use Hash;
use Str;
use App\Models\Settings;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
class AuthController extends Controller
{
    public function dashboard(){
        return view('admin.home');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (Auth::attempt($credentials, request()->has('remember') )) {
            $request->session()->regenerate();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'authenticate' => 'Credentials do not matched our records.'
        ])->withInput();    
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with(['msg' => 'You signed out!', 'msg_type' => 'warning']);
    }
    public function login()
    {
        $Settings = Settings::get('registration');
        return view('auth.login', compact('Settings'));
    }
    public function verificationNotice()
    {
         return view('auth.verify-email');
    }
    public function register(RegisterRequest $request){
        $Settings = Settings::get('registration');

        $userData= $request->getUserData();

        $user = new User;
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];

        if(!isset($Settings['email_verification_on_reg']) || $Settings['email_verification_on_reg'] != 1){
            $user->email_verified_at = $userData['email_verified_at'];
            $user->save();
            $user->assign($Settings['default_role']);
            Auth::loginUsingId($user->id);
            return Redirect::route('admin')->with(['msg' => 'Thanks for registration', 'msg_type' => 'success']);
        }
        else{
            $user->save();
            $user->assign($Settings['default_role']);
            Auth::loginUsingId($user->id);   
            $user->sendEmailVerificationNotification();
            return Redirect::route('verification.notice')->with(['msg' => 'User added', 'msg_type' => 'success']);
        }
    }
    public function forgetPassword()
    {
        return view('auth.forgot-password');
    }
    public function forgetPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    public function resetPaassword($token)
    {
       return view('auth.reset-password', ['token' => $token]);
    }
    public function paasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
        }

}
