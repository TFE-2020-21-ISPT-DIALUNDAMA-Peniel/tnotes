@extends('layouts.default')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-12">
         <h2 class="badge badge-pill badge-info">Liste des enseignant</h2>   
        </div>
    </div>
    <br>
    <button type="button" class="addModal btn btn-primary" data-toggle="modal" data-target="#editModal">
	  <span class="fas fa-plus"> </span> Ajouter enseignant
	</button>
	<br><br>
	<div class="card bg-light mb-3">
	  <div class="card-body">
		{!!$dataTable->table() !!}
	  </div>
	</div>
	@include('partials.includes.formulaires.ajoutProfForm')

</div>
@stop
@push('scripts')
{!!$dataTable->scripts() !!}


@endpush