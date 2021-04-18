
<div class="w-100 d-flex">
 <form class="w-100" action="{{route('triagepreguntas.show',$paciente->Paciente_id)}}" method="GET">
 	@if($us->can('FullPaciente') or $us->can('TriajePaciente'))
    <button type="submit" class="btn btn-sm btn-outline-secondary ">Triaje</button>
    @endif
  </form>
  @if($us->can('FullPaciente') or $us->can('EditarPaciente'))
   <a href="/editar/{{ $paciente->Paciente_id }}"  class="btn btn-sm btn-outline-secondary ml-1">Editar</a> 
  @endif


</div>


