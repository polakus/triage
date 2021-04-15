@if($us->can('FullAtencion') or $us->can('DarAltaAtencion'))
	@if($paciente->estado!="alta")
	<button  onclick="darAlta({{ $paciente->id }})"class="btn btn-mod btn-sm" style="font-size: 13px;">Dar alta</button>

	@endif
@endif