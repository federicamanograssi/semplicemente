@extends('layouts/guest')
@section('title' , 'Single-Apartment | ChaletBnB')

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
            <div class="left-container">

                <section class="type-host">
                    
                    <div class="little-description">
                        <h3>Intero Appartamento - Host: Zia Pina </h3>
                        <p> 2 ospiti &#183 Monolocale &#183 1 Letto &#183 1 Bagno  , Italy</p>
                    </div>
                    <div class="host-img">
                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" alt="host-img">
                    </div>
                </section>
                
                <hr>
                
                <section class="apartment-service">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="service-description">
                            <p>Casa Intera</p>
                            <p>Appartamento:sarà a tua completa disposizione</p>
                        </div>
                    </div>
                </section>

                <hr>

                <section class="apartment-description">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti ratione maiores excepturi nam necessitatibus impedit animi magnam eius quae molestias, quod accusamus quo! Ipsum repellendus eveniet doloremque sed quas ratione.</p>
                    <p><a href="#">Mostra altro</a> </p>
                </section>

                <hr>




            </div>
            <div class="right-container">
                <div class="form">
                    {{-- inserire form inserimento dati --}}
                </div>
                </section>
            </div>

            <section class="apartment-map">
                <h3>Posizione</h3>

                <p>Rome,Italy</p>

                {{-- inserire matta appartamento --}}
            </section>

            <hr>

            <section class="hosted-by">
                <div class="host-img">
                    <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-image-182145777.jpg" alt="host-img">
                </div>
                <div class="little-description">
                    <h3>Host: Zia Pina </h3>
                    <p> Membro da febbraio 2013</p>
                </div>
                
            </section>


        </div>



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



@endsection








