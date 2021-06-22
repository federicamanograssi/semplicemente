@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Le tue statistiche</h1>
            </div>

            <table class="table w-100 table-responsive">

                {{-- titoli colonne --}}
                <thead class="table-light">
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">Statistica 1</th>
                        <th tabindex="0" rowspan="1" colspan="1">Statistica 2</th>
                        <th tabindex="0" rowspan="1" colspan="1">Statistica 3</th>
                        <th tabindex="0" rowspan="1" colspan="1">Statistica 4</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <p>Statistica molto importante</p>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection