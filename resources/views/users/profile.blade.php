@extends('layouts.app')

@section('content')
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <img src="{{ Auth::user()->avatar ? 'data:image/png;base64,'.Auth::user()->avatar : '/uploads/avatars/default.png' }}" class="profile" alt="Imagem de Perfil">
                <h2>Perfil de {{ ucfirst(Auth::user()->name) }}!</h2>
                <hr>
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    @csrf
                    <input type="file" name="avatar" class="mb-4">
                    <input type="submit" value="Carregar imagem" class="pull-right btn btn-sm btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
