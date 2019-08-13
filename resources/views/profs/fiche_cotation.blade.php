@extends('layouts.master-prof')
@include('partials.includes.dataTables.dataTables')
@include('partials.includes.dataTables.buttons')
@section('content')
	<div class="card">
	  <div class="card-header">
	  	Titulaire : {{ $prof->nom .' '.$prof->prenom }}
	  	<br>
	  	Promotion : {{ $auditoire->lib }}
	  	<br>
	  	Cours : {{ $idcours->lib }}
	  	<br>
	  	Max : {{ $idcours->ponderation }}
	  	<br>
	  	<h5><span class="badge badge-pill badge-secondary">Fiche de l' {!! $idtype_cotes->lib !!}</span></h5>
	  </div>
	  <div class="card-body">
	  	{!!$dataTable->table() !!}

	  </div>
	  @if(!App\Models\Fiches_envoye::isSended($idtype_cotes->idtype_cotes,$idcours->idcours))
	  <div class="card-footer text-center">
		<a href="#" id="send-fiche" class="btn btn-primary btn-block">Envoyer la fiche</a>
	  </div>
	  @endif
	</div>
	
	

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		     {{--  <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div> --}}
	            <div class="modal-body">
	    <div class="deleteContent" >
	    	<div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Envoyer la fiche de cotes!</h4>
              <p>Lorsque vous validez, les cotes seront accèssibles par la section et le bureau du jury à l'instant.</p>
              <hr>
              <p class="mb-0">Vous ne pouvez plus modifier les cotes après l'envoi!.</p>
            </div>
	    </div>
        {{-- msg d'erreur --}}
        @include('partials._msgFlash')
        {{-- Formulaire --}}
        <form id="cote-form" action="{{ route('professeur.set_cote') }}" method="POST" name="cote-form" class="form-horizontal">
            @csrf
           <input type="text" name="idcotes" id="fidcotes" style="display: none">
           <input type="text" name="idetudiants" id="fidetudiants" required="" style="display: none">
           <input type="text" name="idcours" id="fidcours" value="{{ $idcours->idcours }}" required="" style="display: none">
           <input type="hidden" name="idtype_cotes" id="fidtype_cotes" value="{{ $idtype_cotes->idtype_cotes }}" required="">
           {{-- <input type="hidden" name="idcotes" id="idcotes" value="{{ $auditoire->idauditoires }}"> --}}
            <div class="form-group">
                <label for="Note"  class="col-sm-2 control-label">Note</label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" id="fcote" name="cote" placeholder="Entrer la Note "  maxlength="50" max="{{ $idcours->ponderation }}" required="" autofocus>
                </div>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a href="{{ route('professeur.send_fiche',['type_cotes'=>$idtype_cotes->idtype_cotes,'cours'=>$idcours->idcours]) }}" class="send_fiche btn btn-primary invisible">Envoyer</a>
        <button type="submit" class="actionBtn save btn btn-primary">Valider</button>
      </div>
        </form>
    </div>
	   
	    </div>
	  </div>
	</div>

@endsection
@push('scripts')
	{!!$dataTable->scripts() !!}

	<script type="text/javascript">
		{{-- edition du formulaire --}}
	$(document).on('click', '.link-cote', function() {
			$('#msgErrors').html('');
      		$('#msgErrors').attr('hidden','true');
      		$('.deleteContent').attr('hidden','true');

			$('#footer_action_button').text(" Update");
			$('#footer_action_button').addClass('fas fa-check');
			$('#footer_action_button').removeClass('fas fa-trash');
			$('.actionBtn').addClass('btn-primary');
			$('.actionBtn').removeClass('btn-danger');
			$('.actionBtn').removeClass('invisible');
			$('.send_fiche').addClass('invisible');
			$('.actionBtn').addClass('edit');
			$('.modal-title').text('Modifier');


			$('.form-horizontal').show();
			var stuff = $(this).data('info').split(',');
			fillmodalData(stuff)
			$('#myModal').modal('show');
			});

	// remplissage formulaire par les donnée d'une ligne selectionée
	function fillmodalData(details){
			$('#fidcotes').val(details[0]);
			$('#fcote').val(details[1]);
			$('#fidetudiants').val(details[2]);
			
			}

	$('#cote-form').on('submit', function(e) {
		e.preventDefault();
		$('#msgErrors').html('');
      	$('#msgErrors').attr('hidden','true');

		$.ajax({
			type: 'post',
			url: '{{ route('professeur.set_cote') }}',
			data: {
				'_token': $('input[name=_token]').val(),
				'idcotes': $("#fidcotes").val(),
				'idetudiants': $("#fidetudiants").val(),
				'idcours': $('#fidcours').val(),
				'idtype_cotes': $('#fidtype_cotes').val(),
				'cote': $('#fcote').val(),
				// 'prenom': $('#fprenom').val(),
				// 'idauditoires': $('#fidauditoires').val(),
				
				},

			success: function(data) {
				$('#dataTableBuilder').DataTable().draw(false);
				$('.modal').modal('hide');
				
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
	$('#send-fiche').on('click', function(e) {
		e.preventDefault();
      	$('.deleteContent').removeAttr('hidden','false');
		$('#footer_action_button').text("Delete");
		$('#footer_action_button').removeClass('glyphicon-check');
		$('#footer_action_button').addClass('glyphicon-trash');
		$('.actionBtn').removeClass('btn-primary');
		$('.actionBtn').addClass('btn-danger');
		$('.actionBtn').removeClass('edit');
		$('.actionBtn').addClass('invisible');
		$('.send_fiche').removeClass('invisible');
		$('.modal-title').text('Delete');
		$('.deleteContent').show();
		$('.form-horizontal').hide();
		$('#exampleModalCenter').modal('show');
		});
	$('.send').on('click', function(e) {
		e.preventDefault();
		alert('k,');
		$('#msgErrors').html('');
      	$('#msgErrors').attr('hidden','true');

		$.ajax({
			type: 'post',
			url: '#',
			data: {
				'_token': $('input[name=_token]').val(),
				'idcours': $('#fidcours').val(),
				'idtype_cotes': $('#fidtype_cotes').val(),
				
				},

			success: function(data) {
				$('.modal').modal('hide');
				
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