<?php

namespace App\Http\Controllers\API;

use App\Helpers\RestApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Moviein;
use Exception;
use Illuminate\Http\Request;

class MovieinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Moviein::all();

        if ($data) {
            return RestApiFormatter::createApi(200, 'Success', $data);
        } else {
            return RestApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_film' => 'required',
                'rating_film' => 'required'
            ]);

            $moviein = Moviein::create([
                'nama_film' => $request ->nama_film,
                'rating_film' => $request->rating_film
            ]);

            $data = Moviein::where('id','=',$moviein->id)->get();

            if ($data) {
                return RestApiFormatter::createApi(200, 'Success', $data);
            } else {
                return RestApiFormatter::createApi(400, 'Failed');
            }

        } catch (Exception $error) {
            return RestApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Moviein::where('id','=',$id)->get();

        if ($data) {
            return RestApiFormatter::createApi(200, 'Success', $data);
        } else {
            return RestApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $moviein = Moviein::findOrFail($id);

        $moviein->nama_film = $request->input('nama_film');
        $moviein->rating_film = $request->input('rating_film');
        $moviein->save();
    
        return response()->json([
            'message' => 'Movie updated successfully!',
            'data' => $moviein
        ], 200);
    }

    /**
     * Get the top rated movies.
     */
    public function topRated()
    {
        $data = Moviein::orderBy('rating_film', 'desc')->take(10)->get();

        if ($data) {
            return RestApiFormatter::createApi(200, 'Success', $data);
        } else {
            return RestApiFormatter::createApi(400, 'Failed');
        }
    }

    public function watched(Request $request, $id)
    {
        $moviein = Moviein::findOrFail($id);

        $moviein->watched = $request->input('watched');
        $moviein->save();

        return response()->json([
            'message' => 'Movie watched status updated successfully!',
            'data' => $moviein
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
