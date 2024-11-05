<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Rules\ValidImageType;
use App\Models\ForgetPassword;
use App\Trait\FileHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public $fileHandler;

    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'email' => 'required',
                    'password' => 'required'
                ]
            );

            if (!Auth::validate($request->only('email', 'password'))) {
                return redirect()->back()->with('error', 'Incorrect email or password');
            }

            $user = User::where('email', $request->email)->first();
            if ($user->is_suspended == 1) {
                return redirect()->back()->with('error', 'Your account is temporarily suspended');
            }

            $remember = $request->remember_me ? true : false;
            $credentials['email'] = $request->email;
            $credentials['password'] = $request->password;
            $credentials['remember'] = $remember;
            $credentials['previous_url'] = $request->previous_url;
            
            $valid = Arr::only($credentials, ['email', 'password']);

            if (Auth::attempt($valid, $credentials['remember'])) {
                session()->regenerate();
        
                return $this->redirectUser();
            } else {
                return redirect()->route('login')->with('error', 'Incorrect email or password');
            }

        } else {
            if (auth()->user()) {
                return $this->redirectUser();
            } else {
                return view('frontend.authentication.login');
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed|min:6'
            ]);

            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'username' => uniqid(),
            ]);
            
            if ($newUser) {
                $request->session()->regenerate();
                Auth::login($newUser);
                return redirect()->route('backend.admin.dashboard')->with('success', 'User registered successfully');
             } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return view('frontend.authentication.sign-up');
        }
    }

    public function forgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'email|required',
            ]);
            $findUser = User::where('email', $request->email)->first();

            $otp = rand(11111, 99999);

            if ($findUser) {
                ForgetPassword::updateOrCreate(
                    [
                        'user_id' => $findUser->id
                    ],
                    [
                        'otp' => $otp,
                        'email' => $findUser->email,
                        'suspend_duration' => now()->addMinutes(5)
                    ]
                );

                session([
                    'user_id' => $findUser->id,
                    'reset-email' => $findUser->email
                ]);

                $mailData = [
                    'title' => readConfig('site_name'),
                    'otp' => $otp,
                    'name' => $findUser->name,
                ];

                Mail::to($findUser->email)->send(new PasswordReset($mailData));

                return redirect()->route('password.reset')->with('success', 'Check your inbox for otp code');
            } else {
                return back()->with('error', 'User not found');
            }
        } else {
            return view('frontend.authentication.forget-password');
        }
    }

    public function resendOtp()
    {
        $findUser = ForgetPassword::where('user_id', session('user_id'))
            ->where('email', session('reset-email'))
            ->first();

        if ($findUser) {
            $user = User::find(session('user_id'));
            $otp = rand(11111, 99999);

            $findUser->otp = $otp;
            $findUser->resent_count++;
            $findUser->suspend_duration = now()->addMinutes(5);
            $findUser->save();

            $mailData = [
                'title' => readConfig('site_name'),
                'otp' => $otp,
                'name' => $user->name,
            ];
            Mail::to($findUser->email)->send(new PasswordReset($mailData));

            return back()->with('success', 'Otp resent successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function newPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);

            $user = User::find(session('user_id'));

            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();

                session()->forget('user_id');

                return redirect()->route('login')->with('success', 'Password reset successfully');
            } else {
                return redirect()->route('forget.password')->with('error', 'Something went wrong');
            }
        } else {
            return view('frontend.authentication.new-password');
        }
    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'number_1' => 'required',
                'number_2' => 'required',
                'number_3' => 'required',
                'number_4' => 'required',
                'number_5' => 'required',
            ]);
            $otp = $request->number_1 . $request->number_2 . $request->number_3 . $request->number_4 . $request->number_5;

            $record = ForgetPassword::where('email', session('reset-email'))
                ->where('otp', $otp)
                ->first();

            if ($record) {
                $record->delete();
                session()->forget('reset-email');

                if (now()->greaterThan(Carbon::parse($record->suspend_duration))) {
                    return redirect()->route('login')->with('error', 'Otp expired');
                }

                return redirect()->route('new.password');
            } else {
                return back()->with('error', 'Invalid otp');
            }
        } else {
            return view('frontend.authentication.reset');
        }
    }

    public function logout()
    {
        if (auth()->user()) {
            Auth::logout();

            return redirect('/');
        } else {
            return back()->with('error', 'You are not logged in');
        }
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_image' => ['file', new ValidImageType]
        ]);

        if ($request->name !== $user->name) {
            $user->name = $request->name;
        }

        if ($request->email !== $user->email) {
            $user->email = $request->email;
            $user->google_id = null;
        }

        if ($request->hasFile("profile_image")) {
            $user->profile_image = $this->fileHandler->fileUploadAndGetPath($request->file("profile_image"), "/public/media/users");
        }

        if ($request->current_password || $request->new_password || $request->confirm_password) {

            $request->validate([
                'new_password' => 'required|min:6|confirmed',
            ]);

            if ($user->is_google_registered) {
                $user->is_google_registered = false;
            } else {
                $request->validate([
                    'current_password' => 'required',
                ]);

                $currentPassword = $request->current_password;

                if (!Hash::check($currentPassword, $user->password)) {
                    throw ValidationException::withMessages([
                        'current_password' => 'The current password is incorrect',
                    ]);
                }
            }

            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Updated Successfully');
    }

    public function redirectUser()
    {
        if (Auth::check()) {
            return redirect()->route('backend.admin.dashboard');
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in');
        }
    }
}
