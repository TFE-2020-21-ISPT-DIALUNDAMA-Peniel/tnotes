@extends('layouts.default')
{{-- @include('partials.includes.dataTables.dataTables') --}}
{{-- @include('partials.includes.dataTables.buttons') --}}
@section('content')
<div class="container">
	@foreach($data as $d)
	    <div class="alert alert-dark" role="alert">
		  <a href="{{ route('jury.get_session_import',$d->idtype_cotes) }}" class="btn btn-block " style="color: black">{!! strtoupper($d->lib) !!}</a>
		</div>
    @endforeach
	
</div>
@stop
@push('scripts')
{{-- {!!$dataTable->scripts() !!} --}}


@endpush