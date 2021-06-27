<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'BoolChalet') }}</title>

    
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    {{-- tolto main js perchè entrava in conflitto con modulo pagamenti --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>
<body>

    {{-- INIZIO PAGINA---- contenitore generale--}}
    <div class="nav_layout h-100">
        
        <nav class="nav_header navbar flex-md-nowrap pl-3 px-3 pr-3">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">BoolChalet</a>
            <ul class="navbar-nav px-3">
                
              <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
        </nav>
    
        <div class="container-fluid h-100">
            {{-- SIDEBAR---------- --}}
            <div class="row">
                {{-- rendere la sidebar responsive --}}
              <nav class="col-md-2 d-md-block">
                <div class="sidebar-sticky">

                    {{-- MENU NAVIGAZIONE --}}
                  <ul class="nav flex-column">
                    {{-- dashboard--- --}}
                    <li class="nav-item">
                      <a class="nav-link active" href={{ route('admin_homepage')}}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
                            <path d="M12 2L2 7l10 5l10-5l-10-5z"></path>
                            <path d="M2 17l10 5l10-5"/><path d="M2 12l10 5l10-5"></path>
                        </svg>
                        Dashboard
                      </a>
                    </li>
                    {{-- Appartamenti--- --}}
                    <li class="nav-item">
                      <a class="nav-link" href={{ route('apartments.index')}}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Appartamenti
                      </a>
                    </li>
                    {{-- Messaggi--- --}}
                    <li class="nav-item">
                      <a class="nav-link" href={{ route('messages.index')}}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <path d="M22 6l-10 7L2 6"></path>
                            
                        </svg>
                        Messaggi
                      </a>
                    </li>
                    {{-- Statistiche--- --}}
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.statistics.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                        Statistiche
                      </a>
                    </li>
                    {{-- Sponsorizzazioni --}}
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.sponsorships.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather-dollar-sign">
                            <path d="M12 1v22"></path>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        Sponsorizzazioni
                      </a>
                    </li>
                  </ul>
                </div>
              </nav>

              {{-- MAIN CONTAINER -------------- --}}
              <main id="app" role="main" class="admin col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
                  
                {{-- FORM PAGAMENTO --}}
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
              </main>
            </div>
    
        </div>
    </div>

    {{-- SCRIPT PER FAR FUNZIONARE PAGAMENTO
    dovuto togliere app.js perchè in conflitto --}}
    <script>
        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: "{{ Braintree\ClientToken::generate() }}",
            container: '#dropin-container'
            }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    $.get('{{ route('admin.payments.make') }}', {payload}, function (response) {
                        console.log(response);

                        // se non vuoi usare alert ma altro messaggio, ricorda che puoi utilizzare setTimeout
                        if (response.success) {
                            alert('Payment successfull!');
                            $(window.location).attr('href', '{{ route('admin.sponsorships.index')}}');
                      
                        } else {
                            alert('Payment failed'); 
                            $(window.location).attr('href', '{{ route('admin.sponsorships.index')}}');
                        }
                    }, 'json');
                });
            });
        });
        </script>
</body>
</html>