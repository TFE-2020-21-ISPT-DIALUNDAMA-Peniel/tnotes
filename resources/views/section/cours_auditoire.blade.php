@extends('layouts.default')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
<div class="container"  >
	<div class="row">
        <div class="col-md-12">
         <h2 class="badge badge-pill badge-info">{{ $auditoire->lib }}</h2>   
        </div>
    </div>
    <br>

	<button type="button" class="addModal btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
	  <span class="fas fa-plus"> </span> Nouveau cours
	</button>
	<br><br>
     {{-- <hr /> --}}
	<div class="card bg-light mb-3">
	  <div class="card-body" >
		{!!$dataTable->table() !!}
	  </div>
	</div>
	@include('partials.includes.formulaires.ajoutCoursForm',['idauditoireSelected'=>$auditoire->idauditoires])



</div>	
@stop
@push('scripts')
{!!$dataTable->scripts() !!}

@endpush