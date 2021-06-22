@extends('layouts.dashboard')

@section('content')
<div class="admin container">
    <div class="row">
        
        {{-- CARD STAT : APPARTAMENTI---- --}}
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">           
                            <div class="info-icon text-center icon-danger">
                                <i>icona</i>
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