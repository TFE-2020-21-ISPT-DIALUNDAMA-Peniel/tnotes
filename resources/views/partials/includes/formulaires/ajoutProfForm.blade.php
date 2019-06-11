<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modifier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- msg d'erreur --}}
        @include('partials._msgFlash')
        {{-- Formulaire --}}
        <form id="profForm" action="{{ route('section.gestion_prof.store') }}" method="POST" name="profForm" class="form-horizontal">
            @csrf
           <input type="hidden" name="idtitulaires" id="fidtitulaires">
            <div class="form-group">
                <label for="matricule"  class="col-sm-2 control-label">Matricule</label>
                <div class="col-sm-12">
                    <input type="text" id="fmatricule" class="form-control" id="matricule" name="matricule" placeholder="Entrer matricule étudiant"  maxlength="50" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="nom"  class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-12">
                    <input type="text" id="fnom" class="form-control" id="nom" name="nom" placeholder="Entrer nom étudiant"  maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="postnom" class="col-sm-2 control-label">Postnom</label>
                <div class="col-sm-12">
                    <input type="text" id="fpostnom" class="form-control" id="postnom" name="postnom" placeholder="Entrer postnom étudiant"  maxlength="50" >
                </div>
            </div>
            <div class="form-group">
                <label for="prenom"  class="col-sm-2 control-label">Prenom</label>
                <div class="col-sm-12">
                    <input type="text" id="fprenom" class="form-control" id="prenom" name="prenom" placeholder="Entrer prenom étudiant"  maxlength="50" >
                </div>
            </div>
            @include('partials.includes.formulaires._getAuditoires');
           
        {{--     <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
             </button>
            </div> --}}
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
	        <button type="submit" class="save btn btn-primary">Enregistrer</button>
	      </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
    
    {{-- Ajout étudiant formulaire --}}
    $(document).on('click', '.addModal', function() {
        $('#msgErrors').html('');
        $('#msgErrors').attr('hidden','true');

        $('.modal-title').text('Ajouter');
        resetmodalData()
        $('.form-horizontal').trigger("reset");
        $('.form-horizontal').show();
        $('#myModal').modal('show');
        });

    {{-- edition du formulaire --}}
    $(document).on('click', '.edit-modal', function() {
            $('#msgErrors').html('');
            $('#msgErrors').attr('hidden','true');

            $('#footer_action_button').text(" Update");
            $('#footer_action_button').addClass('fas fa-check');
            $('#footer_action_button').removeClass('fas fa-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').removeClass('delete');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Modifier');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            var stuff = $(this).data('info').split(',');
            fillmodalData(stuff)
            $('#myModal').modal('show');
            });

    // remplissage formulaire par les donnée d'une ligne selectionée
    function fillmodalData(details){
            $('#fidtitulaires').val(details[0]);
            $('#fmatricule').val(details[1]);
            $('#fnom').val(details[2]);
            $('#fpostnom').val(details[3]);
            $('#fprenom').val(details[4]);
            $('#fidauditoires').val(details[5]);
            // $('#fidauditoires').val(details[4]);
            // $('#gender').val(details[4]);
            // $('#country').val(details[5]);
            // $('#salary').val(details[6]);
            }

    function resetmodalData(){
            $('#fidtitulaires').val('');
            $('#fmatricule').val('');
            $('#fnom').val('');
            $('#fpostnom').val('');
            $('#fprenom').val('');
            // $('#fidauditoires').val('');
            // $('#gender').val(details[4]);
            // $('#country').val(details[5]);
            // $('#salary').val(details[6]);
            }



    $('#profForm').on('submit', function(e) {
        e.preventDefault();
        $('#msgErrors').html('');
        $('#msgErrors').attr('hidden','true');

        $.ajax({
            type: 'post',
            url: '{{ route('section.gestion_prof.store') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'idtitulaires': $("#fidtitulaires").val(),
                'matricule': $("#fmatricule").val(),
                'nom': $('#fnom').val(),
                'postnom': $('#fpostnom').val(),
                'prenom': $('#fprenom').val(),
                'idauditoires': $('#fidauditoires').val(),
                // 'gender': $('#gender').val(),
                // 'country': $('#country').val(),  
                // 'salary': $('#salary').val()
                },

            success: function(data) {
                $('#dataTableBuilder').DataTable().draw(false);
                $('#editModal').modal('hide');
                
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

    {{-- Suppression  --}}
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

</script>
@endpush