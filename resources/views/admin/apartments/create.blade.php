@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Inserisci un nuovo appartamento</h1>
                <a href="{{ route('apartments.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Torna ai tuoi appartamenti
                </a>
            </div>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- INIZIO FORM CREA NUOVO ----- --}}
            {{-- enctype="multipart/form-data" serve epr caricare le img --}}
            <form action="{{ route('apartments.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- TITOLO ---- --}}
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci titolo" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- INDIRIZZO ---- --}}
                <div class="form-group">
                    <label>Indirizzo</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Inserisci indirizzo" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

{{--                
                <div class="row">

                  
                    <div class="form-group col">
                        <label>Latitudine</label>
                        <input type="number" name="latitude" min="0" step='any'class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}" placeholder="Latitudine"required>
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="form-group col">
                        <label>Longitudine</label>
                        <input type="number" name="longitude" min="0" step='any'class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}" placeholder="Longitudine"required>
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                
                <div class="row">

                    {{-- PREZZO--- --}}
                    <div class="form-group col">
                        <label>Prezzo/notte €</label>
                        <input type="number" name="price_per_night" min="0" class="form-control @error('price_per_night') is-invalid @enderror" value="{{ old('price_per_night') }}" placeholder="Inserisci prezzo" required>
                        @error('price_per_night')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DIMENSIONI APPARTAMENTO------ --}}
                    <div class="form-group col">
                        <label>Dimensioni m<sup>2</sup></label>
                        <input type="number" name="dimensions" min="0" class="form-control @error('dimensions') is-invalid @enderror" value="{{ old('dimensions') }}" placeholder="Inserisci dimensioni" required>
                        @error('dimensions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- STANZE------- --}}
                    <div class="form-group col">
                        <label>N° stanze</label>
                        <input type="number" name="rooms_n" min="0" class="form-control @error('rooms_n') is-invalid @enderror" value="{{ old('rooms_n') }}" placeholder="Inserisci stanze" required>
                        @error('rooms_n')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- LETTI------ --}}
                    <div class="form-group col">
                        <label>N° letti</label>
                        <input type="number" name="beds_n" min="0" class="form-control @error('beds_n') is-invalid @enderror" value="{{ old('beds_n') }}" placeholder="Inserisci letti"required>
                        @error('beds_n')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- BAGNI-------- --}}
                    <div class="form-group col">
                        <label>N° bagni</label>
                        <input type="number" name="bathroom_n" min="0" class="form-control @error('bathroom_n') is-invalid @enderror" value="{{ old('bathroom_n') }}" placeholder="Inserisci bagni"required>
                        @error('bathroom_n')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>

                {{-- DESCRIZIONE-------- --}}
                <div class="form-group">
                    <label>Descrizione</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Inserisci una descrizione" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- SERVIZI ------ --}}
                <div class="form-group">
                    <p>Seleziona i servizi:</p>

                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-3 form-check @error('services') is-invalid @enderror">
                                <input name="services[]" class="form-check-input" type="checkbox" value="{{ $service->id }}"
                                {{ in_array($service->id, old('services', [])) ? 'checked=checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $service->service_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('services')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- IMMAGINI----- --}}
                {{-- <div class="form-group"> --}}
                    {{-- <label>Immagini</label> --}}
                    {{-- multiple serve per mettere più immagini --}}
                    {{-- <input class='form-control-file' type="file" name="images[]" multiple>
                </div> --}}

            {{-- PROVA PIU' INPUT IMMAGINI --}}
            <label>Immagini:</label>
            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                <div class="row" id="add_more">
                    <div class= "col-2">
                        <img id="img1" src="https://www.maniboo.it/wp-content/uploads/2019/11/no-image.jpg" />
                        <input class='form-control-file' type="file" name="image1" id="img_input1">
                        <input type="text" name="img_description1" placeholder="Descrizione">
                    </div>
                </div>

                <input type="hidden" name="n_img" id="n_img" value= "0">

                <p>Visibile:</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="visible" id="1" class="form-control @error('visible') is-invalid @enderror" value="1"  checked required>
                    <label class="form-check-label" for="1">
                      Sì
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="visible" id="1" class="form-control @error('visible') is-invalid @enderror" value="0"  checked required>
                    <label class="form-check-label" for="0">
                      No
                    </label>
                    @error('visible')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
            

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Crea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">

    img{
        width: 100px;
        height: auto;
        display: block;
    }

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

var i = 1;
var j = 1;
    
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img'+i).attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img_input"+i).change(function(){
        readURL(this);
    });

$("#add").click(function(){

    ++i;
    ++j; 

    $("#add_more").append('<div class="col-2 remove-div"><img id="img'+i+'" src="https://www.maniboo.it/wp-content/uploads/2019/11/no-image.jpg"/><input class="form-control-file" type="file" name="image'+i+'" id="img_input'+i+'"><input type="text" name="img_description'+i+'" placeholder="Descrizione"><button type="button" class="btn btn-danger remove-input">Remove</button></div>');

    document.getElementById("n_img").setAttribute('value', j);

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img'+i).attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#img_input"+i).change(function(){
        readURL(this);
    });
});


    $(document).on('click', '.remove-input', function(){  
        --j;
        $(this).parents('.remove-div').remove();
        document.getElementById("n_img").setAttribute('value', j);

    });  



</script>
@endsection
