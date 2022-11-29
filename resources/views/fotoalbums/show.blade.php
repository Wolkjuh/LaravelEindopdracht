@extends('layouts.app')

@section('content')
    <div class="container-fotoalbum">
        @foreach($fotos as $foto)
            <div class="fotoalbum-item">
                <a href="/fotoalbum/{{ $foto->id }}">
                    <img class="fotoalbum-image" src="/public/Image/{{ $foto->image }}" alt="">
                </a>
                <p class="fotoalbum-ptag">{{ $foto->title }}</p>
                @if(Route::has('login'))
                    <p class="fotoalbum-ptag"><a href="/foto/edit/{{ $foto->id }}">Bewerken</a></p>
                    <p class="fotoalbum-ptag"><a href="/foto/delete/{{ $foto->id }}">Verwijderen</a></p>
                @endif
            </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Voeg foto toe!</div>

                    <div class="card-body">
                        <form action="/fc/{{ $fotoalbum->id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Titel</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('titel') is-invalid @enderror" name="title" value="{{ old('name') }}" required autocomplete="title" autofocus>

                                    @error('categorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>

                                <div class="col-md-6">
                                    <input type="file" name="image">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Voeg toe
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
