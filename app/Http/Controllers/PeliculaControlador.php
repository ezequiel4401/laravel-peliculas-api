<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PeliculaControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Pelicula::all();
        return $peliculas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;
        $pelicula->genero = $request->genero;
        $pelicula->director = $request->director;
        $pelicula->comentario = $request->comentario;

        $archivo = $request->file('archivo');
        $nombre = date('YmdHis') . '.' . $archivo->getClientOriginalExtension();
        $archivo->move('assets/', $nombre);
        $pelicula->archivo = $nombre;
        
        $pelicula->save();
        return $pelicula;
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelicula = Pelicula::find($id);
        return $pelicula;
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
        $pelicula = Pelicula::find($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->duracion = $request->duracion;
        $pelicula->genero = $request->genero;
        $pelicula->director = $request->director;
        $pelicula->comentario = $request->comentario;

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre = date('YmdHis') . '.' . $archivo->getClientOriginalExtension();
            $archivo->move('assets/', $nombre);

            $path = 'assets/' . $pelicula->archivo;

            File::delete($path);

            $pelicula->archivo = $nombre;

        }
        
        $pelicula->save();
        return $pelicula;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = Pelicula::find($id);
        $path = 'assets/' . $pelicula->archivo;
        File::delete($path);
        $pelicula->delete();
        return $id;
    }
}
