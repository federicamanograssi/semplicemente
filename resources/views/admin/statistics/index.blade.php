@extends('layouts.dashboard')

@section('content')

<admin-statistics-page>
</admin-statistics-page>
{{-- select --}}
{{-- <select class="custom-select custom-select-lg mb-3">
    <option selected>Seleziona Appartamento</option>
    @foreach ($apartments as $apartment)
    <option value="{{$apartment->id}}">{{$apartment->title}}</option>
    @endforeach
  </select> --}}


<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="3em" height="3em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8s11 8 11 8s-4 8-11 8s-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></g></svg>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Visualizzazioni</p>
                                <h3 class="card-title">numero</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i>Totali questo mese</i>
                    </div>
                </div>
            </div>
        </div>
    
     
        <div class="col-lg-4 col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="3em" height="3em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></g></svg>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Messaggi</p>
                                <h3 class="card-title">numero</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i>Totali ricevuti</i>
                    </div>
                </div>
            </div>
    
        </div>
        
    
        <div class="col-lg-4 col-md-12">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="3em" height="3em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></g></svg>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Spese</p>
                                <h3 class="card-title">numero</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i>Sponsorizzazione questo mese</i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

      
        <div class="col-12">
            <div class="card card-chart">

               
                <div class="card-header">
                    <h5 class="card-category">Visualizzazioni totali</h5>
                    <h3 class="card-title">
                        <i> Numero +icona</i>
                    </h3>
                </div>

               
                <div class="card-body">
                    <div class="chart-area">
                        mettere chart
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection