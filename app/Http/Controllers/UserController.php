<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{
    public function index(Type $var = null)
    {
        return response()->json(User::all());
    }
    // Get register form
    public function register_form()
    {
        
        return response()->json('register form');
    
    }

    // Register
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
           
        }catch(Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage());
        }
    }

    // Get log in form
    public function login_form()
    {
       // return view file with route login
       return response()->json('log in form');
    }

    // Log in
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
                "This credentials don't match!"
            ];
        } 

        $token = $user->createToken("access_token")->plainTextToken;

        $response = [
            "token" => $token,
            "user" => $user
        ];

        if ($user->usertype == 'admin') {
            // return view file for admin (dashbord)
            return response()->json($response);
        }
        else{
            // return view file for normal user
            return response()->json($response);
        }
        
                    
    }

    // log out
    public function logout(User $user)
    {
        $user->tokens()->delete();
        
        return response()->json('user logout');
    }
}
