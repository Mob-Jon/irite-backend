<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Search;

class SearchController extends Controller
{
    public function search($title)
    {
        // return response()->json($title);
        return Story::where("title","like","%".$title."%")->get();


    }
        // return Search::where('title',"like","%".$title."%")->get();
        // return response()->json($title);
    }

    //store data from the database
    // public function store(Request $request)
    // {
    //     if ($request->ajax()){
    //         try {
    //             //  Transacciones
    //             DB::beginTransaction();                              

    //             $title    = $request->title;
    //             $genre  = $request->genre;
    //             $description = $request->description;               

    //             for($count = 0; $count < count($title); $title++)
    //             {
    //                 $insert = array(                        
    //                     'code_insert' => $code_insert[$count],
    //                     'quality'     => $quality[$count]
    //                 );
    //                 $insert_data[] = $insert; 

    //                 $tool = array(
    //                     'position'    => $position[$count],
    //                     'code_tool'   => $code_tool[$count],
    //                     'insert_id'   => $insert_data[$count]

    //                 );
    //                 $tool_data[] = $tool;
    //             }

    //             dd($tool_data);

    //             Insert::insert($title);
    //             Tool::insert($title);                   


    //             DB::commit();

    //         } catch (Exception $e) {
    //             // anula la transacion
    //             DB::rollBack();
    //         }
    //     }    
    // }
