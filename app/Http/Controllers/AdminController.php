<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminController extends Controller
{
    public function register_admin(Request $request)
    {
        return view('');
        DB::beginTransaction();

        try{
        //input fields
            $validate = $request->validate([
                'email'=>'required|email',
                'password'=>'required|min:8|max:12|same:confirmPassword',
                'confirmPassword'=>'required'
            ]);

        //database fields
            $admin =
                Admin::create([
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            DB::commit();
            return response()->json($admin);

            /* TO BE USE */
            // if(!is_null($user)) {
            //     return redirect()->route('home')->with("success", "Success! Registration completed");
            // }

            // else {
            //     return back()->withErrors($user);
            // }
            return response()->json("Successfully Created!");
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    //failed login
    private function loginFailed()
    {
        return redirect()

        ->back()
        ->withInput()
        ->with('error','Login failed, please try again!');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only("email","password");

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()
            //Authentication passed
                ->intended('home.admin')
                ->with('status','You are Logged in as Admin!');
        }
            //Authentication
            return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ]);
        return $this->loginFailed();
    } 
        public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            
            return redirect('/');
        }
    }
    

