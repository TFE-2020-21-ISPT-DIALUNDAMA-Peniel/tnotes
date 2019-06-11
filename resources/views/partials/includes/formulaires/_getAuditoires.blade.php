@inject('auditoires', 'App\Models\Auditoire')

<div class="form-group">
    <label class="col-sm-2 control-label">Auditoire</label>
    <div class="col-sm-12" id="audit">
        @php 
        $disabled = !empty($idauditoireSelected) ? 'disabled' : ''; @endphp
        <select class="form-control" id="fidauditoires" name="idauditoires" required="" {{ $disabled }}>
            @foreach($auditoires::getAuditoireGroupBySection() as $sections)
                <optgroup label="{{ $sections[0]->section_lib  }}">
                    @foreach ($sections as $auditoire)
                        @if(!empty($idauditoireSelected) && $idauditoireSelected == $auditoire->idauditoires)
                        <option value="{{ $auditoire->idauditoires }}" selected >{{ $auditoire->lib }}</option>
                        @else
                        <option value="{{ $auditoire->idauditoires }}"  >{{ $auditoire->lib }}</option>
                        @endif
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
</div>