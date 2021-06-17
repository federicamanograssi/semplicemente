<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Font AweSome CDN     --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Dinamyc Title --}}
    <title>@yield('title')</title>
</head>

<body>
    <div id="app">
    
    {{-- Header Component --}}

    @php

        $homePage = array(
            'label' => 'Home Page' ,
            'slug'  => route('guest-home') ,
            'icon'  => 'fas fa-home'
        );

        $advancedSearch = array(
            'label' => 'Ricerca Avanzata' ,
            'slug'  => route('search') ,
            'icon'  => 'fas fa-search-location'
        );

        $logIn = array(
            'label' => 'logIn' ,
            'slug'  => route('admin_homepage') ,
            'icon'  => 'fas fa-sign-in-alt'
        );

        $menuItems = array( 0 => $homePage , 1 => $advancedSearch , 2 => $logIn);
        
    @endphp

    
    <header-guest :items="{{ json_encode($menuItems)}}"></header-guest>
    
    {{-- Main Here --}}
    
    @yield('main')

    {{-- Footer Here --}}
</div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>