@extends('layouts/guest')
@section('title' , 'Advanced Search | ChaletBnB')

@php

    // Controllo se esiste il parametro url 'location'

    if(isset($_GET['location'])){
        $destination = $_GET['location'];
    }
    else {
        $destination = '';
    }
@endphp

@section('main')

    <advanced-search-page destination="{{$destination}}">
        <!-- Search page component -->
    </advanced-search-form>

@endsection