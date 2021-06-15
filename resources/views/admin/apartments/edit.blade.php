@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modfica appartamento ' {{ $apartment->title }} '</h1>
                <a href="{{ route('apartments.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i tuoi appartamenti
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
            <form action="{{ route('apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Inserisci il titolo" value="{{ old('title', $apartment->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>N° stanze</label>
                    <input type="number" name="rooms_n" min="0" class="form-control @error('rooms_n') is-invalid @enderror" value="{{ old('rooms_n', $apartment->rooms_n) }}" placeholder="Inserisci il numero delle stanze" required>
                    @error('rooms_n')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>N° letti</label>
                    <input type="number" name="beds_n" min="0" class="form-control @error('beds_n') is-invalid @enderror" value="{{ old('beds_n', $apartment->beds_n) }}" placeholder="Inserisci il numero dei letti"required>
                    @error('beds_n')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>N° bagni</label>
                    <input type="number" name="bathroom_n" min="0" class="form-control @error('bathroom_n') is-invalid @enderror" value="{{ old('bathroom_n', $apartment->bathroom_n) }}" placeholder="Inserisci il numero dei bagni"required>
                    @error('bathroom_n')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Dimensioni</label>
                    <input type="number" name="dimensions" min="0" class="form-control @error('dimensions') is-invalid @enderror" value="{{ old('dimensions', $apartment->dimensions) }}" placeholder="Inserisci le dimensioni in mq" required>
                    @error('dimensions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Latitudine</label>
                    <input type="number" name="latitude" min="0" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $apartment->latitude) }}" placeholder="Latitudine"required>
                    @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Longitudine</label>
                    <input type="number" name="longitude" min="0" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $apartment->longitude) }}" placeholder="Latitudine"required>
                    @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Prezzo per notte</label>
                    <input type="number" name="price_per_night" min="0" class="form-control @error('price_per_night') is-invalid @enderror" value="{{ old('price_per_night', $apartment->price_per_night) }}" placeholder="Inserisci il prezzo in €" required>
                    @error('price_per_night')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Descrizione</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Inserisci una descrizione" required>{{ old('description', $apartment->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <p>Seleziona i servizi:</p>
                    @foreach ($services as $service)
                        <div class="form-check @error('services') is-invalid @enderror">
                            <input name="services[]" class="form-check-input" type="checkbox" value="{{ $service->id }}"
                            {{ $apartment->services->contains($service) ? 'checked=checked' : '' }}>
                            <label class="form-check-label">
                                {{ $service->service_name }}
                            </label>
                        </div>
                    @endforeach
                    @error('services')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Immagini</label>
            {{-- multiple serve per mettere più immagini --}}
                    <input class='form-control-file' type="file" name="img_path" multiple>
                </div>

                <p>Visibile:</p>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="visible" id="1" class="form-control @error('visible') is-invalid @enderror" value="1"  {{ $apartment->visible == '1' ? 'checked=checked' : '' }}>
                    <label class="form-check-label" for="1">
                      Sì
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="visible" id="1" class="form-control @error('visible') is-invalid @enderror" value="0"  {{ $apartment->visible == '0' ? 'checked=checked' : '' }} >
                    <label class="form-check-label" for="0">
                      No
                    </label>
                    @error('visible')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
            

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Salva 
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
