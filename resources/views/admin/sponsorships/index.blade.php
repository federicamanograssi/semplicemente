@extends('layouts.dashboard')

@section('content')

<admin-sponsorships-page 
:apartments="{{ $apartments }}"
:sponsorships="{{ $sponsorships}}">
</admin-sponsorships-page>



@endsection