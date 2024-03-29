<?php

namespace App\Http\Controllers\auth;

use App\Clientinfo;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginIndex()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                // The passwords match...
                //check if rehash needed
                if (Hash::needsRehash($user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                }

                auth()->attempt([
                    'email' => request('email'),
                    'password' => request('password')
                ]);

                if ($user->type == 'admin') {
                    return redirect('/dashboard');
                }
                if ($user->type == 'client') {
                    //check if email verified

                    if ($user->email_verified == false) {
                        return redirect('/verify-your-email');
                    }
                    return redirect('/');
                }
            }
        }
        return back();
    }
    public function registerIndex()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }
    //register
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (User::where('email', $request->email)->count() == 0) {

            $user = User::create([
                'type' => 'client',
                'email' =>  $request->email,
                'password' => bcrypt($request->password),
                'email_verified' => false,
            ]);

            $clientinfo = Clientinfo::create([
                'user_id' =>  $user->id,
                'name' =>  $request->name,
                'phone' =>  $request->phone,
                'address' =>  $request->address,

            ]);

            //send email
            $email = $request->email;
            $name = $request->name;
            $data = array(
                'user_id' => $user->id
            );
            Mail::send('mail.emailverify', $data, function ($message) use ($email, $name) {
                $message->from('wtntestserver@gmail.com', 'Annapurna Distributors');
                $message->to($email, $name);
                $message->subject('Verify Email Address ');
            });

            return redirect('/verify-your-email');
        }
        return back();
    }

    public function registerAdmin()
    {
        $email = "admin@admin.com";
        $password = "admin";

        if (User::where('email', $email)->count() == 0) {
            $user = User::create([
                'type' => 'admin',
                'email' => $email,
                'password' => bcrypt($password),
                'email_verified' => true,
            ]);

            return Response($user);
        } else {

            return Response("User already created");
        }
    }


    public function verifyEmailView()
    {
        return view('site.verifyemail');
    }
    public function verifyEmail(Request $request)
    {

        if (!empty($request->id)) {
            $user =  User::find($request->id);
            if ($user) {
                $user->email_verified = true;
                $user->save();
                return redirect('/');
            }
            return redirect('/404');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
