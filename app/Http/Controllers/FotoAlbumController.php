<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFotoalbumRequest;
use App\Http\Requests\UpdateFotoAlbumRequest;
use App\Models\Foto;
use App\Models\Fotoalbum;

class FotoAlbumController extends Controller
{
    public function show()
    {
        $fotoalbums = Fotoalbum::all()->sortByDesc('created_at');
        return view('fotoalbums.index', compact("fotoalbums"));
    }

    public function store(CreateFotoalbumRequest $request)
    {
        $newFotoAlbum = new Fotoalbum();

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $newFotoAlbum['image'] = $filename;
        }

        $newFotoAlbum['categorie'] = $request['categorie'];
        $newFotoAlbum->save();

        return redirect('/fotoalbums');
    }

    public function showOne(Fotoalbum $fotoalbum)
    {
        $fotos = Foto::where("fotoalbums_id", $fotoalbum->id)->get();
        return view('fotoalbums.show', compact('fotoalbum', 'fotos'));
    }

    public function edit(Fotoalbum $fotoalbum)
    {
        return view('fotoalbums.edit', compact('fotoalbum'));
    }

    public function update(Fotoalbum $fotoalbum, UpdateFotoAlbumRequest $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $fotoalbum->image = $filename;
        }

        if ($request['categorie'])
        {
            $fotoalbum->categorie = $request['categorie'];
        }
        $fotoalbum->save();

        return redirect("/fotoalbums");
    }

    public function delete(Fotoalbum $fotoalbum)
    {
        Foto::where('fotoalbums_id', $fotoalbum->id)->delete();
        Fotoalbum::where('id',$fotoalbum->id)->delete();
        return redirect("/fotoalbums");
    }
}
