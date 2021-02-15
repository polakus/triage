<div class="form-row">
 <form class= "form-inline" action="{{route('triagepreguntas.show',$Paciente_id)}}" method="GET">
    <button type="submit" class="btn btn-sm btn-outline-secondary ml-1">Triaje</button>
  </form>
  <a href="/editar/{{ $Paciente_id }}"  class="btn btn-sm btn-outline-secondary ml-1">Editar</a>
</div>