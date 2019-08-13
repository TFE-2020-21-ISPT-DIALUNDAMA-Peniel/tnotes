@extends('layouts.default')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
<div class="container"  >
	{{-- <div class="row">
        <div class="col-md-12">
         <h2 class="badge badge-pill badge-info">Liste des cours</h2>   
        </div>
    </div> --}}
    
     {{-- <hr /> --}}
	<div class="card bg-light mb-3">
		<div class="card-header">
		  	Titulaire : {{ $cours->nom .' '.$cours->prenom }}
		  	<br>
		  	Promotion : {{ $auditoire->lib }}
		  	<br>
		  	Cours : {{ $cours->lib }}
		  	<br>
		  	Max : {{ $cours->ponderation }}
		  	<br>
		  	<h5><span class="badge badge-pill badge-secondary">Fiche de l' {!! $type_cotes->lib !!}</span></h5>
	   </div>
	  <div class="card-body" >
		{!!$dataTable->table() !!}
	  </div>
	</div>
</div>	
@stop
@push('scripts')
{!!$dataTable->scripts() !!}
@endpush