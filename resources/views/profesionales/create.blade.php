@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Registrar un profesional</h1>
        
</div>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>
<form method="POST" action="/profesionales">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Nombre">
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="inputEmail4">Apellido</label>
            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" placeholder="Apellido">
            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
        </div>
        <div class="form-group col-md-4">
            <label for="inputZip">Matrícula</label>
            <input type="number" name="matricula" class="form-control @error('matricula') is-invalid @enderror" value="{{ old('matricula') }}" placeholder="Matricula">
            @error('matricula')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
                <label for="inputZip">DNI</label>
                <input type="number" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" placeholder="Número de Documento">
                @error('dni')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="inputAddress">Domicilio</label>
            <input type="text" name="domicilio" class="form-control @error('domicilio') is-invalid @enderror" value="{{ old('domicilio') }}" placeholder="Dirección">
            @error('domicilio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <label for="inputAddress">Telefono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="Dirección">
            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Especialidades <h style="color:#E0E0E0">(Ctrl + Click para seleccionar más de una opción)</h></label>
        <select multiple class="form-control" name="esp[]" id="esp[]">
            @foreach($especialidades as $especialidad)
            <option value="{{$especialidad->id}}" {{ (collect(old('esp'))->contains($especialidad->id)) ? 'selected':'' }}>{{$especialidad->nombre}}</option>
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Registrar</button>
    <a class="btn btn-default btn-close" href="{{ route('profesionales.index') }}">Volver</a>
</form>



@endsection
