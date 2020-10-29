@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar pescado</h1>
        <form action="{{ route('pescado.store', ['pescaria' => $pescaria]) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome da espécie</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="weight">Massa(kg)</label>
                <input type="number" name="weight" class="form-control" id="weight">
            </div>
            <div class="form-group">
                <label for="size">Tamanho(cm)</label>
                <input type="number" name="size" class="form-control" id="size">
            </div>
            <div class="form-group">
                <label for="image">Imagem</label>
                <input id="image" type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
