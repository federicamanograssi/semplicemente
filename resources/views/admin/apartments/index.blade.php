@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="tab-title">Appartamenti</h1>
            <p>Qui puoi visualizzare, modificare o cancellare i tuoi appartamenti</p>
        </div>

        <div class="col-12 text-right">
            <a href="{{ route('apartments.create') }}" class="btn btn-our-btn">
                Inserisci nuovo appartamento
            </a>
        </div>
        <div class="col-12">
            <h3>Lista appartamenti</h3>
            <table class="table table-striped">
                <thead>
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1" aria-sort="ascending">Titolo</th>
                        <th tabindex="0" rowspan="1" colspan="1">Località</th>
                        <th tabindex="0" rowspan="1" colspan="1">Dimensioni</th>
                        <th tabindex="0" rowspan="1" colspan="1">Prezzo</th>
                        <th tabindex="0" rowspan="1" colspan="1">Stanze</th>
                        <th tabindex="0" rowspan="1" colspan="1">Letti</th>
                        {{-- <th tabindex="0" rowspan="1" colspan="1">Bagni</th> --}}
                        <th tabindex="0" rowspan="1" colspan="1">Visibile</th>
                        <th rowspan="1" colspan="1" class="action-bigger">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($apartments as $apartment)
                        
                    {{-- riga appartamento --}}
                    <tr role="row">
                        <td class="sorting_1">
                            <img src="" alt="" class="rounded me-3">
                            <p class="m-0 d-inline-block align-middle font-16">
                                <a href="{{ route('apartments.show',$apartment->id)}}" class="text-body">{{ $apartment->title }}</a>
                                <br>
                                @for ($i = 0; $i < floor($apartment['rating']); $i++)
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87l1.18 6.88L12 17.77l-6.18 3.25L7 14.14L2 9.27l6.91-1.01L12 2z"></path>
                                        </svg>
                                    </span>
                                    
                                @endfor
                            </p>
                        </td>
                        <td class="text-left">{{ $apartment->address }}</td>
                        <td class="text-right">{{ $apartment->dimensions }} m<sup>2</sup></td>
                        <td class="text-right">{{ $apartment->price_per_night }} €</td>
                        <td class="text-right">{{ $apartment->rooms_n }}</td>
                        <td class="text-right">{{ $apartment->beds_n }}</td>
                        {{-- <td class="text-right">{{ $apartment->bathroom_n }}</td> --}}
                        <td class="text-right">
                            @if ( $apartment['visible'] == 1)
                                sì
                            @else
                                no   
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- EDIT --}}
                            <a href="{{ route('apartments.edit', $apartment->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                            </a>
                            {{-- MESSAGES --}}
                            <a href="{{route('messages.index', $apartment->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <path d="M22 6l-10 7L2 6"></path>
                                    
                                </svg>
                            </a>
                            {{-- STATISTICS --}}
                            <a href="{{ route('admin.statistics.index', $apartment->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>
                            </a>
                            {{-- DELETE --}}
                            <a onclick="confirmDelete()" style="cursor:pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </a>
                            {{-- <form class="d-inline-block" action="{{ route('apartments.destroy',$apartment->id) }}" method="post">
                                @csrf
                                @method('DELETE') --}}
                                {{-- <button onclick="confirmDelete()" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button> --}}
                            {{-- </form> --}}
                        </td>
                    </tr>
            
                    @endforeach
                    
                </tbody>
            </table>

            <div class="popup-box" id="popup-box">
                <p>Confermi l'eliminazione?</p>
                <button onclick="chiudi()">No</button>
                <form class="d-inline-block" action="{{ route('apartments.destroy',$apartment->id) }}" method="post">
                    @csrf
                    @method('DELETE') 
                <button class="btn-danger" type="submit">Sì</button>
                </form>
            </div>


                    {{-- @foreach ($apartments as $apartment)
                            <h3>{{ $apartment->images->first()->img_path}}</h3>
                            <h3>{{ $apartment->title }}</h3>
                            <h3>{{ $apartment->description }}</h3>
                            <h3>{{ $apartment->price_per_night }}</h3>
                            <h3>Servizi:</h3>
                            <ul>
                                @foreach ($apartment->services as $service)
                                    <li>{{ $service->service_name }} </li>
                                @endforeach
                            </ul>

                                <a class="btn btn-info btn-sm" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{ route('apartments.edit', $apartment->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg>
                                </a>
                                <form class="d-inline-block" action="{{ route('apartments.destroy', $apartment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </form>
                    @endforeach --}}

        </div>
    </div>
</div>

@endsection
<style>
    .popup-box {
        visibility: hidden;
        position: absolute;
        text-align: center;
        padding: 5px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        height: 80px;
        width: 230px;
        background-color:#385744;
        color: #ffefd5;
    }

</style>
<script>

function chiudi() {
    document.getElementById('popup-box').style.visibility="hidden";
    
}

function confirmDelete() {
    document.getElementById('popup-box').style.visibility="visible";
}





</script>