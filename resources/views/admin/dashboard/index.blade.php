@extends('layouts.dashboard')

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            chart
        </div>
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
                                <p class="card-category">NOme stat</p>
                                <h3 class="card-title">numero</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="stats">
                        <i>Nel periodo</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection