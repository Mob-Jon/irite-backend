<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{
    public function index_register()
    {
        return view('registration-form');
    }
    //function to register
    public function register(Request $request)
    {
        DB::beginTransaction();

        try{
            $validate = $request->validate([
                'username' =>'required',
                'dateOfBirth' =>'required|date|before:18 years ago',
                'email'=>'required|email',
                'password'=>'required|min:8|max:12|confirmed',
                
            ],
            [
                'dateOfBirth.before' => 'You must be atleast 18 years old.'
            ]);

            $user = User::create([
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
                return redirect()->route('home')->with("success", "Success! Registration completed");
            }

            else {
                return back()->withErrors($user);
            }
        
            
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }
    //function for admin side
    public function adminRegister(Request $request)
    {
        DB::beginTransaction();

        try{
            $validate = $request->validate([
                'username' =>'required',
                'email'=>'required|email',
                'password'=>'required|min:8|max:12',
                     
            ]);
            $user = 
                User::create([
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'usertype'=>"admin"
                ]);
            DB::commit();
            return response()->json($user);

            /* TO BE USE */
            if(!is_null($user)) {
                return redirect()->route('home')->with("success", "Success! Registration completed");
            }

            else {
                return back()->withErrors($user);
            }
        
            
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }




    public function index_login()
    {
       return view('login-form');
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
}
