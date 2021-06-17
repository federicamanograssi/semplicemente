@extends('layouts.guest')
@section('title', 'Single-Apartment | ChaletBnB')

@section('main')
    <main>

        <div class="container">
            <section class="apartment-title">
                <h2>{{$apartment->title}}</h2>
                <div class="rating-location">
                    <p> <i class="fas fa-star"></i> {{$apartment->rating}} &#183 {{$apartment->address}}</p>
                </div>
            </section>
        </div>


        <img-slider></img-slider>

        <div class="container">
            <div class="form-container">
                <div class="left-container">

                    <section class="type-host">

                        <div class="little-description">
                            <h3>Intero Appartamento - Host: Zia Pina </h3>
                            <p> {{$apartment->rooms_n}} stanze &#183 
                                @if($apartment['beds_n'] ==1) 
                                    1 Letto 
                                @else 
                                    {{$apartment->beds_n}} Letti
                                @endif
                                &#183 
                                @if($apartment['bathroom_n'] ==1) 
                                    1 Bagno 
                                @else 
                                    {{$apartment->bathroom_n}} Bagni
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
                                        {{$apartment->beds_n}} Ospiti
                                    @endif
                                </p>
                                <p>Capienza fino a
                                    @if($apartment['beds_n'] ==1) 
                                    1 Ospite
                                    @else 
                                        {{$apartment->beds_n}} Ospiti
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
                                        {{$apartment->beds_n}} Bagni
                                    @endif
                                </p>
                                <p>Asciugamani e prodotti per la pulizia inclusi.</p>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="apartment-description">
                        <p>{{$apartment->description}}</p>
                    </section>

                    <hr>

                    <section class="additional-services">
                        <h3>Servizi Inclusi</h3>
                        <div class="row">
                            <div class="ad-service-card">
                                <div class="ad-service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="ad-service-description">
                                    <span>Cucina</span>
                                </div>
                            </div>
                            <div class="ad-service-card">
                                <div class="ad-service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="ad-service-description">
                                    <span>Cucina</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="ad-service-card">
                                <div class="ad-service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="ad-service-description">
                                    <span>Cucina</span>
                                </div>
                            </div>
                            <div class="ad-service-card">
                                <div class="ad-service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="ad-service-description">
                                    <span>Cucina</span>
                                </div>
                            </div>
                        </div>

                            

                        
                    </section>


                

                </div>

                <div class="right-container">
                    <div class="contact-form">

                        <h3>Contatta l'host per conoscere i dettagli</h3>
                        <p> <i class="fas fa-star"></i> 5.0 &#183 Rome , Italy</p>
                        {{-- FORM INVIO MESSAGGIO----------- --}}
                        <form action="{{ route('message.store') }}" method="post" enctype="multipart/form-data">

                            {{-- MAIL---------- --}}
                            <div class="form-group">
                                <input type="email" name="email_sender" class="form-control @error('email_sender') is-invalid @enderror" placeholder="Inserisci email" value="{{ old('email_sender') }}" required>
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

                            {{-- <label class="form__label" for="name">Nome</label>
                            <input class="form__input" id="name" name="name" type="text" placeholder="Inserisci il tuo nome">
                            <label class="form__label" for="email">Email</label>
                            <input class="form__input" id="email" name="email" type="email" placeholder="Inserisci la tua email">
                            <label class="form__label" for="message">Messaggio</label>
                            <textarea class="form__input" name="message" id="message" name="message" placeholder="Inserisci il messaggio per il venditore"></textarea> --}}

                           <button class="btn btn--primary" type="submit">Invia Messaggio</button>

                        </form>
                        

                    </div>
                </div>
            </div>

            <hr>

            <section class="apartment-map">
                <div class="map-title">
                    <h3>Posizione</h3>

                    <p>{{$apartment->address}}</p>
                    <p>
                        <span><strong>Lat:</strong>{{$apartment->latitude}}</span> <span><strong>Lon:</strong>{{$apartment->longitude}}</span>
                    </p>

                </div>
                

                <section class="chalet-map">            
                    <!-- 
                        La mappa è provvisoriamente 
                        integrata da Google Maps 
                    -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54471.2440560787!2d12.052418201662949!3d46.66978139530556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47783435d247033f%3A0xdd3c30437b92e42b!2s32043%20Cortina%20d&#39;Ampezzo%20BL!5e1!3m2!1sit!2sit!4v1623660828144!5m2!1sit!2sit" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </section>

                {{-- inserire mappa appartamento --}}
            </section>

            <hr>

            <section class="hosted-by">
                <section class="type-host">

                    <div class="host-img">
                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg"
                            alt="host-img">
                    </div>

                    <div class="little-description">
                        <h3>Host: Zia Pina </h3>
                        <p> Membro da gennaio 2015</p>
                    </div>
                    
                </section>

                <section class="redirect-btn">
                    {{--Al click la pagina si ridireziona al form di inserimento messaggio --}}

                    <button class="btn btn--primary">
                        Contatta l'host ora
                    </button>
                </section>

            </section>


        



        </main>

        <section class="footer-top">
            <div class="sponsored-gallery">
                <h3>Gli alloggi sponsorizzati</h3>

                <div class="sponsored-card">
                    <div class="card-img">
                        <img src="https://www.arredoshop.it/4984-large_default/camera-da-letto-luisa.jpg" alt="">
                    </div>
                    <div class="card-description">
                        <div class="card-rating">
                            <p class="little"><i class="fas fa-star"></i>5</p>
                        </div>
                        <div class="card-title">
                            Titolo dell'appartamento
                        </div>
                    </div>
                </div>
            </div>
        </section>


        

        <hr>


        <section class="footer-bottom">

    </div>

    @endsection
