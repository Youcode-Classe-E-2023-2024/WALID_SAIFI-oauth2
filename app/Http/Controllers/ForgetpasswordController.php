<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class ForgetpasswordController extends Controller
{
    public  function fogetpassword(){
        return view('forget_password');
    }

    public  function fogetpasswordPost(Request $request){
     $request->validate([
         'email' => 'required|email'
     ]);

     $token = Str::random(64);

     DB::table('password_reset_tokens')->insert([
          'email' => $request->email,
          'token' => $token,
          'created_at' => Carbon::now()
     ]);
     Mail::send('Email.forget_password', ['token' => $token], function ($message) use($request){
         $message->to($request->email);
         $message->subject("Reste password");
     });

     return redirect()->to(route('login'))->with("success","we have..............");
    }

    public function rest_password($token){
      return view('new_password', compact('token'));
        //dd($token);
    }
    public  function  rest_passwordPost(Request $request){
        //dd($request);
     $request->validate([
         'email' => 'required|email',
         'password' => 'required|confirmed',
         'password_confirmation' => 'required'
     ]);
     $updatPassword = DB::table('password_reset_tokens')->where([
         "email" => $request->email,
         "token" => $request->token_email
     ])->first();
     if(!$updatPassword){
         return redirect()->to(route('login'))->with("error" , "Invalid");
     }
     User::where("email", $request->email)
         ->update(["password" => Hash::make($request->password)]);

     DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();
     return  redirect()->to(route("login"))->with("success","password rest success");
    }

}
