@inject('titulaires', 'App\Models\Titulaire')

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nouveau cours</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- msg d'erreur --}}
        @include('partials._msgFlash')
        {{-- Formulaire --}}
        <form id="etudiantForm" action="{{ route('section.gestion_cours.store') }}" method="POST" name="etudiantForm" class="form-horizontal">
            @csrf
           <input type="hidden" name="idcours" id="fidcours">
           <input type="hidden" name="idauditoires" id="fidauditoires" value="{{ $auditoire->idauditoires }}">
            <div class="form-group">
                <label for="cours"  class="col-sm-2 control-label">Cours</label>
                <div class="col-sm-12">
                    <input type="text"  class="form-control" id="fcours" name="cours" placeholder="Entrer le nom du cours"  maxlength="100" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="ponderation"  class="col-sm-2 control-label">Ponderation</label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" id="fponderation" name="ponderation" placeholder="Entrer la ponderation du cours"  maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="ponderation"  class="col-sm-2 control-label">Titulaire</label>
                <div class="col-sm-12">
                    <select class="form-control" id="ftitulaire" name="titulaire">
                      <option></option>
                        @foreach($titulaires->get() as $titulaire)
                        <option value="{{ $titulaire->idtitulaires }}">{{ $titulaire->nom .' '. $titulaire->prenom }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('partials.includes.formulaires._getAuditoires');
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="save btn btn-primary">Enregistrer</button>
      </div>
        </form>
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
    $('.form-horizontal_create').trigger("reset");
    $('.form-horizontal_create').show();
    $('#myModal').modal('show');
    });

  {{-- edition du formulaire --}}
  $(document).on('click', '.edit-modal', function() {
      $('#msgErrors').html('');
      $('#msgErrors').attr('hidden','true');
      $('#footer_action_button').text(" Update");
      $('#footer_action_button').addClass('fa fa-check');
      $('#footer_action_button').removeClass('fa fa-trash');
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
      $('#fidcours').val(details[0]);
      $('#fcours').val(details[1]);
      $('#fponderation').val(details[2]);
      $('#ftitulaire').val(details[3]);
      $('#fidauditoires').val(details[4]);
     
      }

  function resetmodalData(){
      $('#fidcours').val('');
      $('#fcours').val('');
      $('#fponderation').val('');
      $('#ftitulaire').val('');
     
      }



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
    $('.divd').text(stuff[0]);
    $('.dname').html(stuff[1] +" "+stuff[2]);
    $('#myModal').modal('show');
  });

</script>
@endpush