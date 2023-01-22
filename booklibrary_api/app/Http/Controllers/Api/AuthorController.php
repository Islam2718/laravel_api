<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $authors = DB::table('authors')->get();
            return response()->json($authors, 200);
        }catch(Exception $e){         
            // return $authors; 
            return response()->json($e->getMessage(),422);
            // echo 'Message: ' .$e->getMessage();
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|unique:authors',
            'designation' => '',
        ]);

        // Create a new resource with the validated data
        $resource = DB::table('authors')->insert($validatedData);

        // Return a response indicating that the insert was successful
        return response()->json(['message' => 'Saved successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $authors = DB::table('authors')->where('id',$id)->first();
            return response()->json($authors, 200);
        }catch(Exception $e){         
            // return $authors; 
            return response()->json($e->getMessage(),422);
            // echo 'Message: ' .$e->getMessage();
        }             
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the resource in the database
        $authors = DB::table('authors')->where('id',$id)->first();

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required',
            // add more validation rules as necessary
        ]);

        // Update the resource with the new data
        DB::table('authors')->update($validatedData);

        // Return a response indicating that the update was successful
        return response()->json(['message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $authorDelete = DB::table('authors')->where('id', $id)->delete();
            return response()->json($authorDelete, 200);
        }catch(Exception $e){         
            // return $authors; 
            return response()->json($e->getMessage(),422);
            // echo 'Message: ' .$e->getMessage();
        }
    }
}
