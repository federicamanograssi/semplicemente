@extends('layouts/guest')
@section('title', 'Single-Apartment | ChaletBnB')

@section('main')
    <main>

        <div class="container">
            <section class="apartment-title">
                <h2>Chalet meglio di casa tua sicuro</h2>
                <div class="rating-location">
                    <p> <i class="fas fa-star"></i> 5.0 &#183 Rome , Italy</p>
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
                            <p> 2 ospiti &#183 Monolocale &#183 1 Letto &#183 1 Bagno , Italy</p>
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
                                <p class="font-weight--bold">2 Ospiti</p>
                                <p>Capienza fino a due ospiti!</p>
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
                                <p class="font-weight--bold">1 Bagno</p>
                                <p>Pisciate tutti in compagnia!</p>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="apartment-description">
                        <p>Descrizione accurata ipsum dolor sit amet consectetur adipisicing elit. Corrupti ratione maiores excepturi nam
                            necessitatibus impedit animi magnam eius quae molestias, quod accusamus quo! Ipsum repellendus
                            eveniet doloremque sed quas ratione.</p>
                        <p><a href="#">Mostra altro <i class="fas fa-chevron-right"></i></a> </p>
                    </section>

                    <hr>

                    <section class="additional-services">
                        <h3>Servizi Aggiuntivi</h3>
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
                        <form action="#">
                            <h3>Contatta l'host per conoscere i dettagli</h3>
                            <p> <i class="fas fa-star"></i> 5.0 &#183 Rome , Italy</p>

                            <label class="form__label" for="name">Nome</label>
                            <input class="form__input" id="name" name="name" type="text" placeholder="Inserisci il tuo nome">
                            <label class="form__label" for="email">Email</label>
                            <input class="form__input" id="email" name="email" type="email" placeholder="Inserisci la tua email">
                            <label class="form__label" for="message">Messaggio</label>
                            <textarea class="form__input" name="message" id="message" name="message" placeholder="Inserisci il messaggio per il venditore"></textarea>

                           <button class="btn btn--primary" type="submit">Contatta l'host ora</button>

                        </form>
                        

                    </div>
                </div>
            </div>

            <hr>

            <section class="apartment-map">
                <div class="map-title">
                    <h3>Posizione</h3>

                    <p>Rome,Italy</p>
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
            <div class="container">
                <div class="sponsored-gallery">
                    
                    <h3>Gli alloggi sponsorizzati</h3>
                    <sponsored-slider></sponsored-slider>
                    
                </div>
            </div>   
        </section>


    </div>

    @endsection
