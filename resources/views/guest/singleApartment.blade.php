@extends('layouts.guest')
@section('title', 'Single-Apartment | ChaletBnB')

@section('headPush')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
@endsection

{{-- @dump($apartment) --}}

@section('main')
                    
    <main class="standard-padding">

        <div class="container">
            <section class="apartment-title">
                <h2>{{$apartment['title']}}</h2>
                <div class="rating-location">
                    <p> <i class="fas fa-star"></i> {{$apartment['rating']}} &#183 {{$apartment['address']}}</p>
                </div>
            </section>
        </div>

        <img-slider :photos="{{json_encode($apartment['images'])}}">

            {{-- slider immagini appartamento --}}

        </img-slider>


        <div class="container">
            <div class="form-container" id="form-anchor">
                <div class="left-container">

                    <section class="type-host">

                        <div class="little-description">
                            <h3>Intero Appartamento - Host: {{ $apartment['host']['name']}} {{ $apartment['host']['surname'] }} </h3>
                            <p> 
                                
                                
                                @if($apartment['rooms_n'] ==1) 
                                    1 Camera 
                                @else 
                                    {{$apartment['rooms_n']}} Camere
                                @endif
                                &#183

                                @if($apartment['beds_n'] ==1) 
                                    1 Letto 
                                @else 
                                    {{$apartment['beds_n']}} Letti
                                @endif
                                &#183

                                @if($apartment['bathroom_n'] ==1) 
                                    1 Bagno 
                                @else 
                                    {{$apartment['bathroom_n']}} Bagni
                                @endif
                            </p>

                        </div>
                        <div class="host-img">
                            <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg"
                                alt="host-img">
                        </div>

                    </section>

                    <hr>

                    <section class="apartment-service">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="service-description">
                                <p class="font-weight--bold">Casa Intera</p>
                                <p>Appartamento:sarà a tua completa disposizione</p>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="service-description">
                                <p class="font-weight--bold">
                                    @if($apartment['beds_n'] ==1) 
                                    1 Ospite
                                    @else 
                                        {{$apartment['beds_n']}} Ospiti
                                    @endif
                                </p>
                                <p>Capienza fino a
                                    @if($apartment['beds_n'] ==1) 
                                    1 Ospite
                                    @else 
                                        {{$apartment['beds_n']}} Ospiti
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-house-user"></i>
                            </div>
                            <div class="service-description">
                                <p class="font-weight--bold">Monolocale</p>
                                <p>Tutto ciò che ti serve a portata di mano</p>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-shower"></i>
                            </div>
                            <div class="service-description">
                                <p class="font-weight--bold">
                                    @if($apartment['bathroom_n'] ==1) 
                                    1 Bagno
                                    @else 
                                        {{$apartment['beds_n']}} Bagni
                                    @endif
                                </p>
                                <p>Asciugamani e prodotti per la pulizia inclusi.</p>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="apartment-description">
                        <p>{{$apartment['description']}}</p>
                    </section>

                    <hr>

                    <section class="additional-services">

                        <h3>Servizi Inclusi</h3>
                        <div class="service-list">

                            @foreach ($apartment['services'] as $service)
                            
                                <div class="single-service">
                                    <i class="single-service__icon fas fa-{{$service['service_icon']}}"></i>
                                    <span class="single-service__name">{{$service['service_name']}}</span>
                                </div>                            
                            
                            @endforeach
                            
                        </div>

                    </section>

                </div>

                <div class="right-container">
                    <div class="contact-form">

                        {{-- FORM INVIO MESSAGGIO----------- --}}
                        <form action="{{ route('saveMessage') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <h3>Contatta l'host per conoscere i dettagli</h3>
                            <p> <i class="fas fa-star"></i> 5.0 &#183 Rome , Italy</p>

                            {{-- MAIL---------- --}}
                            <div class="form-group">
                                <input type="email" name="email_sender" class="form__input" placeholder="Inserisci email" value="{{ old('email_sender') }}" required>
                                @error('email_sender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TESTO MESSAGGIO----------- --}}
                            <div class="form-group">
                                <textarea class="form__input" name="message_text" id="message_text" name="message_text" placeholder="Scrivi un messaggio per il proprietario"></textarea>
                                @error('message_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ID APT---------- --}}
                            <div class="form-group">
                                <input type="hidden" name="apartment_id" value="{{ $apartment['id'] }}">
                            </div>

                           <button class="btn btn--primary" type="submit">Invia Messaggio</button>

                        </form>
                        

                    </div>
                </div>
            </div>

            <hr>
            
            {{-- Mappa appartamento --}}

            <section class="apartment-map">
                <div class="map-title">
                    <h3>Posizione</h3>

                    <p>{{$apartment['address']}}</p>
                    <p>
                        <span><strong>Lat:</strong>{{$apartment['latitude']}}</span> <span><strong>Lon:</strong>{{$apartment['longitude']}}</span>
                    </p>

                </div>
                
            <single-chalet-map
                :longitude="{{$apartment['longitude']}}" 
                :latitude="{{$apartment['latitude']}}">
    
                <!-- Mappa -->
    
            </single-chalet-map>

            </section>

            {{-- Piccola Sezione Host             --}}

            <section class="hosted-by">
                <section class="type-host">

                    <div class="host-img">
                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg"
                            alt="host-img">
                    </div>

                    <div class="little-description">
                        <h3>Host: {{ $apartment['host']['name']}} {{ $apartment['host']['surname'] }} </h3>
                        <p> Membro da gennaio 2015</p>
                    </div>
                    
                </section>

                <section class="redirect-btn">
                    {{--Al click la pagina si ridireziona al form di inserimento messaggio --}}

                    <a href="#form-anchor" class="btn btn--primary host-btn">
                        Contatta l'host ora
                    </a>
                </section>

            </section>

            {{-- Slider di apt sponsorizzati (da integrare se c'è tempo) --}}

        {{-- <section class="footer-top standard-padding">
            <div class="container">
                <div class="sponsored-gallery">
                    
                    <h3>Gli alloggi sponsorizzati</h3>
                    <sponsored-slider></sponsored-slider>
                    <div class="sponsored-slider-phone">
                        <div class="slider-phone-cards">
                            <div class="slider-phone-card">
                                <div class="slider-phone-img">
                                    <img src="https://st.hzcdn.com/simgs/pictures/facades-de-maisons/chalet-montagne-impuls-architectures-img~1fa14b10048ae580_4-9910-1-424b58c.jpg" alt="#">
                                </div>
                                <div class="slider-phone-description">
                                    <div class="slider-rating">
                                        <span><i><i class="fas fa-star"></i></i>5</span>
                                    </div>
                                    <div class="slider-title">
                                        Chalet Sponsorizzato 1
                                    </div>
                                </div>
                            </div>

                            <div class="slider-phone-card">
                                <div class="slider-phone-img">
                                    <img src="https://st.hzcdn.com/simgs/pictures/facades-de-maisons/chalet-montagne-impuls-architectures-img~1fa14b10048ae580_4-9910-1-424b58c.jpg" alt="#">
                                </div>
                                <div class="slider-phone-description">
                                    <div class="slider-rating">
                                        <span><i><i class="fas fa-star"></i></i>5</span>
                                    </div>
                                    <div class="slider-title">
                                        Chalet Sponsorizzato 2
                                    </div>
                                </div>
                            </div>

                            <div class="slider-phone-card">
                                <div class="slider-phone-img">
                                    <img src="https://st.hzcdn.com/simgs/pictures/facades-de-maisons/chalet-montagne-impuls-architectures-img~1fa14b10048ae580_4-9910-1-424b58c.jpg" alt="#">
                                </div>
                                <div class="slider-phone-description">
                                    <div class="slider-rating">
                                        <span><i><i class="fas fa-star"></i></i>5</span>
                                    </div>
                                    <div class="slider-title">
                                        Chalet Sponsorizzato 3
                                    </div>
                                </div>
                            </div>

                            <div class="slider-phone-card">
                                <div class="slider-phone-img">
                                    <img src="https://st.hzcdn.com/simgs/pictures/facades-de-maisons/chalet-montagne-impuls-architectures-img~1fa14b10048ae580_4-9910-1-424b58c.jpg" alt="#">
                                </div>
                                <div class="slider-phone-description">
                                    <div class="slider-rating">
                                        <span><i><i class="fas fa-star"></i></i>5</span>
                                    </div>
                                    <div class="slider-title">
                                        Chalet Sponsorizzato 4
                                    </div>
                                </div>
                            </div>

                            
                        </div>                        
                    </div>
                </div>
            </div>   
        </section> --}}


    </div>

@endsection
