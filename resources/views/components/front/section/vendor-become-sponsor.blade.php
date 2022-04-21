<div class="sponsorBecome" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
    @if(isset($fields['heading']))
        <h3 class="ft-blanka ftw-bold_36">{!! $fields['heading'] !!}</h3>
    @endif
    @if(isset($fields['description']))
  		<p>{!! $fields['description'] !!}</p>
  	@endif
    <button class="btn-custom" type="button" data-bs-toggle="modal" data-bs-target="#sponsorForm">{{ (isset($fields['cta_text'])) ? $fields['cta_text'] : $fields['cta_action'] }}</button>
</div>