@extends("triagepreguntas.test")


@section("cuerpo")

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Pacientes para atender</h4>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

      <div id="Salas">
        <form method="POST" action="/atencionclinica/sala">
          @csrf
        <h5>Indicar en que sala se encuentra situado</h5>
        <div class="form-row">
        
          <div class="form-group col-md-4" style="font-size: 17px;">
              <label for="inputState">Sala</label>
              <select name="sala" id="sala" class="form-control select">
                
                    @foreach($salas as $s)
                        
                        <option value="{{ $s->id}}-{{ $s->nombre }} {{ $s->nombre }} ">{{ $s->nombre }} {{ $s->nombre }}</option>
                    @endforeach
              </select>
          </div>

      </div>
      <div class="row">
        <div class="col col-4">
          <button  type="submit" class="btn btn-outline-secondary btn-sm" style="width: 100%;">Listo</button>
        </div>
        
      </div>
      </form>
      </div>



@endsection
