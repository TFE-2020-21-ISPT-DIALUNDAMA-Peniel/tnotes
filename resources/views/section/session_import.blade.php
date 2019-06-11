@extends('layouts.default')
@section('content')
<div class="container"  >
	<div class="row">
        <div class="col-md-12">
         {{-- <h2 class="badge badge-pill badge-info">Liste des auditoires</h2>    --}}
        </div>
    </div>
    
     {{-- <hr /> --}}
		  
		  	@foreach($data as $d)
		    <div class="alert alert-dark" role="alert">
			  <a href="{{ route('section.get_session_import',$d->idtype_cotes) }}" class="btn btn-block " style="color: black">{!! strtoupper($d->lib) !!}</a>
			</div>
		    @endforeach
</div>	
@stop
@push('scripts')
@endpush