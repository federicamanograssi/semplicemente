@extends('layouts.dashboard')

@section('content')

<admin-statistics-page
    :apartments= "{{$apartments}}"
    :views="{{$views}}"
    :messages="{{$messages}}"
    :sponsorships="{{$sponsorships}}">
</admin-statistics-page>

@endsection