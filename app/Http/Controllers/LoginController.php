<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\login;

class LoginController extends Controller
{

    public function display_log_in(){
        return view('login');
    }

    public function Log_in(Request $request){

        DB::beginTransaction();

        try{
            $request->validate([
                'name'=>'required',
                'password'=>'required|min:8|max:12'
            ]);
            login::where('name', $request->name)->first();
            // redirect()->route('home');
            return response()-json('success login');

        }
        catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            // return redirect()->back()->withInput()->withErrors(['errors', 'failed to login']);
            return $e->getMessage();
        }
    }

}
