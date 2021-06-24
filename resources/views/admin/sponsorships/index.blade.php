@extends('layouts.dashboard')

@section('content')

{{-- select --}}
<select class="custom-select custom-select-lg mb-3">
    <option selected>Seleziona Appartamento</option>
    @foreach ($apartments as $apartment)
    <option value="{{$apartment->id}}">{{$apartment->title}}</option>
    @endforeach
</select>


<div class="container-fluid">
    
    INSERIRE SCHEDA PAGAMENTI
</div>

@endsection