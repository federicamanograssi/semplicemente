@extends('layouts/guest')
@section('title' , 'Advanced Search | ChaletBnB')

@php

    // Controllo se esiste il parametro url 'location'

    if(isset($_GET['location'])){
        $location = $_GET['location'];
    }
    else {
        $location = '';
    }
@endphp
@section('main')

    <main class="main main--advanced-search">

        {{-- <search-section></search-section> --}}

        <advanced-search-form location="{{$location}}">
            <!-- Search Form -->
        </advanced-search-form>

        <apartments-list class="apartments-list--full-width">

            {{-- 
                In questo punto devo sapere cosa cercare. 
                Qualunque cosa sia (ad esempio una query)
                Posso passarla al component tramite props
            --}}

        </apartments-list>

        <section class="chalet-map">
            <!-- 
                La mappa è provvisoriamente 
                integrata da Google Maps 
            -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54471.2440560787!2d12.052418201662949!3d46.66978139530556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47783435d247033f%3A0xdd3c30437b92e42b!2s32043%20Cortina%20d&#39;Ampezzo%20BL!5e1!3m2!1sit!2sit!4v1623660828144!5m2!1sit!2sit" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
        <div>

        <div class="chalet-map__button-container">
            <div class="chalet-map__button chalet-map__button--close">
                <i class="fas fa-times"></i>
            </div>
            
            <div class="chalet-map__button chalet-map__button--open hidden">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>

    </main>

@endsection