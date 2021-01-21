<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{
    public function register_home()
    {
        //return view file with route register
    
    }

    public function register(Request $request)
    {
        DB::beginTransaction();

        try{
            $validate = $request->validate([
                'username' =>'required',
                'dateOfBirth' =>'required',
                'email'=>'required|email',
                'password'=>'required|alpha_num|min:8|max:12|confirmed',
                
            ]);
            $user = 
                User::create([
                    'username'=>$request->username,
                    'date-of-birth'=>$request->dateOfBirth,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'usertype'=>"user"
                ]);
            DB::commit();
            return response()->json($user);

            /* TO BE USE */
            if(!is_null($user)) {
                return redirect()->route('login');
            }

            else {
                return back()->withErrors($user);
            }
        
            
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    public function login_form()
    {
       // return view file with route login
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        
        $user = User::where('email', $credentials["email"])->first();
        if(!$user || !Hash::check($credentials["password"], $user->password)) {
            return [
                "This credential doesn't match!"
            ];
        } 

        $token = $user->createToken("access_token")->plainTextToken;

        $response = [
            "token" => $token,
            "user" => $user
        ];
        return redirect()->intended('home');
                    
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home')-with(['message'=>'See you next time']);
    }
}
