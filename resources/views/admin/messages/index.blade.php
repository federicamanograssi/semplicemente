@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Tutti i tuoi messaggi</h1>
            </div>

            <table class="table w-100 table-responsive">

                {{-- titoli colonne --}}
                <thead class="table-light">
                    <tr role="row">
                        <th tabindex="0" rowspan="1" colspan="1">Appartamento</th>
                        <th tabindex="0" rowspan="1" colspan="1">Contatto</th>
                        <th tabindex="0" rowspan="1" colspan="1">Testo del messaggio</th>
                        <th tabindex="0" rowspan="1" colspan="1">Data</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach ($messages as $message)
                        
                    {{-- riga appartamento --}}
                    <tr role="row">
                        <td class="text-left">{{ $message->apartment->title }}</td>
                        <td class="text-right"><a href="mailto:{{ $message->email_sender }}">{{ $message->email_sender }}</a></td>
                        <td class="text-right">{{ $message->message_text }}</td>
                        <td class="text-right">{{ $message->created_at }}</td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection