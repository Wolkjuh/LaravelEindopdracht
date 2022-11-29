@extends('layouts.app')

@section('content')
    <div class="container-fotoalbum">
        @foreach($fotoalbums as $fotoalbum)
            <div class="fotoalbum-item">
                <a href="/fotoalbum/{{ $fotoalbum->id }}">
                    <img class="fotoalbum-image" src="/public/Image/{{ $fotoalbum->image }}" alt="">
                </a>
                <p class="fotoalbum-ptag">{{ $fotoalbum->categorie }}</p>
                @if(Route::has('login'))
                    <p class="fotoalbum-ptag"><a href="/fotoalbum/edit/{{ $fotoalbum->id }}">Bewerken</a></p>
                    <p class="fotoalbum-ptag"><a href="/fotoalbum/delete/{{ $fotoalbum->id }}">Verwijderen</a></p>
                @endif
            </div>
        @endforeach
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Voeg fotoalbum toe!</div>

                    <div class="card-body">
                        <form action="/fa" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="categorie" class="col-md-4 col-form-label text-md-end">Categorie</label>

                                <div class="col-md-6">
                                    <input id="categorie" type="text" class="form-control @error('titel') is-invalid @enderror" name="categorie" value="{{ old('name') }}" required autocomplete="categorie" autofocus>

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
