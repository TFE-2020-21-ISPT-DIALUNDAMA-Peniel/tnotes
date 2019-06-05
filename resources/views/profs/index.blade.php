@extends('layouts.master-prof')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
	<div class="card">
	  <div class="card-header">
	  	{{ auth()->user()->nom .' '. auth()->user()->prenom}}
	  	<br>
	  	
	  </div>
		<div class="card-body">
			{!!$dataTable->table() !!}
		</div>
	</div>
	

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		     {{--  <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div> --}}
	      <div class="modal-body">
	        @inject('type_cotes','App\Models\Type_cote')
	        <div class="container">
	        	@foreach($type_cotes->get() as $tc)
	        	<a href="#" data-type_cote="{{ $tc->idtype_cotes  }}" class="link-cours btn btn-info btn-block">{!! $tc->lib !!}</a>
	        	@endforeach
	        </div>
	      </div>
	      {{-- <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div> --}}
	    </div>
	  </div>
	</div>

@endsection
@push('scripts')
	{!!$dataTable->scripts() !!}
	<script type="text/javascript">
		idcours = 0;
		$(document).on('click','.fiche-cote', function() {
		var field = $(this).data('info').split(',');
		idcours = field[0];
		var link = $('.link-cours');
		
	});

		$(document).on('click','.link-cours',function(e){
			e.preventDefault();
			var idtype_cotes = $(this).data('type_cote');
			$.ajax({
			type: 'post',
			url: '{{ route("professeur.redirect_fiche") }}',
			data: {
				'_token': $('input[name=_token]').val(),
				'cours': idcours,
				'session': idtype_cotes,
				},

			success: function(data) {
				location = data
				
			},

	        error:function(data) {
		        var errors = data.responseJSON.errors;
		          $.each(errors, function (key, value) {
		          	document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
		            $('#msgErrors').removeAttr('hidden');
		        });
		    }
		});
		});
	</script>
@endpush