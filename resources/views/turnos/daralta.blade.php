
@if($estado!="alta")
<button {{-- href="{{ route('turnos.edit',$id) }}" --}} onclick="darAlta({{ $id }})"class="btn btn-mod btn-sm" style="font-size: 13px;">Dar alta</button>

@endif