@extends('layouts/guest')
@section('title' , 'ChaletBnB')

@section('main')
    <main>
        <home-jumbo></home-jumbo>

        <section class="home-section featured-apartments">
            <h2 class="home-section__heading heading--primary">
                Le nostre scelte Top
            </h2>
            <apartments-list class="apartments-list--responsive"></apartments-list>
        </section>

        
        <section class="home-section become-host">
            <div class="become-host__background">
                <div class="become-host__text-box">
                    <a class="become-host__cta" href="#">Diventa un Host</a>
                </div>
            </div>
        </section>

        <section class="home-section featured-locations">

            <h2 class="home-section__heading heading--primary">
                Le destinazioni più richieste
            </h2>
            
            <locations-list class="locations-list--responsive"></locations-list>
            
        </section>

    </main>
@endsection