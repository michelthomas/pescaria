@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar pescaria</h1>
        <form action="{{ route('pescaria.store') }}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="place">Endereço</label>
                <input type="text" name="place" class="form-control" id="place">
            </div>
            <div class="form-group">
                <label for="date">Data</label>
                <input type="date" name="date" class="form-control" id="date">
            </div>
            <div class="form-group">
                <label for="hour">Hora</label>
                <input type="time" name="hour" class="form-control" id="hour">
            </div>
            <div class="form-group">
                <label for="participantes">Participantes</label>
                <select name="participantes[]" multiple class="custom-select" id="participantes">
                    @foreach($friends as $friend)
                        <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                    @endforeach

                    @error('')
                        <p class="smal alert-danger">{{ $message }}</p>
                    @enderror
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
