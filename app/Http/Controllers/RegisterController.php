<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();

        try{
            //input fields
            $request->validate([
                'username' =>'required',
                'dateOfBirth' =>'required',
                'email'=>'required',
                'password'=>'required'
            ]);
            //database fields
            $data = 
            Register::create([
                'username'=>$request->username,
                'date-of-birth'=>$request->dateOfBirth,
                'email'=>$request->email,
                'password'=>$request->password

            ]);
            DB::commit();
            return response()->json($data->username);
            // return redirect()->route('Home');
        
            
        }catch(Exception $e){
            return $e;
        }
    }
}
