<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFotoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Models\Foto;
use App\Models\Fotoalbum;

class FotoController extends Controller
{
    public function index(Fotoalbum $fotoalbum)
    {
        return view('fotos.create', compact('fotoalbum'));
    }

    public function store(Fotoalbum $fotoalbum, CreateFotoRequest $request)
    {
        $foto = New Foto();

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $foto['image'] = $filename;
        }

        $foto['title'] = $request['title'];
        $foto['fotoalbums_id'] = $fotoalbum->id;
        $foto->save();

        return redirect("/fotoalbum/".$fotoalbum->id);
    }

    public function editShow(Foto $foto)
    {
        return view('fotos.edit', compact('foto'));
    }

    public function update(Foto $foto, UpdateFotoRequest $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $foto->image = $filename;
        }

        $foto->title = $request['title'];
        $foto->save();

        return redirect("/fotoalbums");
    }

    public function delete(Foto $foto)
    {
        Foto::where('id',$foto->id)->delete();
        return redirect("/fotoalbums");
    }
}
