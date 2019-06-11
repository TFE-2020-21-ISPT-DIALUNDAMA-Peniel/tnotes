@extends('layouts.default')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
<div class="container">
	<h3>{{ $auditoire->lib }}</h3>
	{{-- <a  href="{{ route('section.getListStudentEnroles',$auditoire->idauditoires) }}" type="button" class="btn btn-info">
  		<span class="fa fa-user"> </span> Etudiants enrôlés
	</a><br><br> --}}
	<div class="create">
		<button type="button" class="addModal btn btn-info" data-toggle="modal" data-target="#editModal">
	  		 <span class="fa fa-plus"> </span> Ajouter un étudiant
		</button>
	</div>
	<br>
	<div class="card bg-light mb-3">
	  <div class="card-body">
		{!!$dataTable->table() !!}
	  </div>
	</div>
	@include('partials.includes.formulaires.ajoutEtudiantForm',['idauditoireSelected'=>$auditoire->idauditoires])

</div>
@stop
@push('scripts')
{!!$dataTable->scripts() !!}
@endpush