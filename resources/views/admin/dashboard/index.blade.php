@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        {{-- CARD STAT : APPARTAMENTI---- --}}
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="info-icon text-center icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8s11 8 11 8s-4 8-11 8s-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></g></svg>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Appartamenti</p>
                                <h3 class="card-title">numero</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i>Totale Appartamenti</i>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- CARD STAT : VISUALIZZAZIONI---- --}}
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="info-icon text-center icon-danger">
                                <i></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">VIEW</p>
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
    
        {{-- CARD STAT : MESSAGGI---- --}}
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="info-icon text-center icon-danger">
                                <i></i>
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
        
        {{-- CARD STAT : SPESE---- --}}
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="info-icon text-center icon-danger">
                                <i></i>
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

        {{-- CHART ANDAMENTO Visualizzazioni--}}
        <div class="col-12">
            <div class="card card-chart">

                {{-- titolo Chart --}}
                <div class="card-header">
                    <h5 class="card-category">Visualizzazioni totali</h5>
                    <h3 class="card-title">
                        <i> Numero +icona</i>
                    </h3>
                </div>

                {{-- body chart --}}
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