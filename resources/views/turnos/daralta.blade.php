
@if($estado!="alta")
<button {{-- href="{{ route('turnos.edit',$id) }}" --}} onclick="darAlta({{ $id }})"class="btn btn-success btn-sm">Dar alta</button>

@endif